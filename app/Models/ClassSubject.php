<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ClassSubject extends Model
{
    use HasFactory;
    protected $table = 'class_subject';

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getRecord(){
        $return = self::select('class_subject.*', 'classes.name as class_name', 'subjects.name as subject_name', 'users.name as created_by_name')
                    ->join('subjects', 'subjects.id', '=', 'class_subject.subject_id')
                    ->join('classes', 'classes.id', '=', 'class_subject.class_id')
                    ->join('users', 'users.id', '=','class_subject.created_by')
                    ->where('class_subject.is_deleted', '=', 0);
                    if(!empty(Request::get('class_name'))){
                        $return = $return->where('classes.name', 'like', '%'.Request::get('class_name').'%');
                    }
                    if(!empty(Request::get('subject_name'))){
                        $return = $return->where('subjects.name', 'like', '%'.Request::get('subject_name').'%');
                    }
                    if(!empty(Request::get('date'))){
                        $return = $return->whereDate('class_subject.created_at', '=', Request::get('date').'%');
                      }
        $return = $return->orderBy('class_subject.id', 'desc')
                         ->paginate(20);

        return $return;
    }

    static public function getAlreadyFirst($class_id, $subject_id){
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }

    static public function getAssignedSubjectId($class_id){
        return self::where('class_id', '=', $class_id)->where('is_deleted', '=', 0)->get();
    }

    static public function deleteSubject($class_id){
        return self::where('class_id', '=', $class_id)->delete();
    }

}