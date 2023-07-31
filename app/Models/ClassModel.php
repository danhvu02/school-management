<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getRecord(){
        $return = self::select('classes.*', 'users.name as created_by_name')
                     ->join('users', 'users.id', 'classes.created_by');
                     
                      if(!empty(Request::get('name'))){
                        $return = $return->where('classes.name', 'like', '%'.Request::get('name').'%');
                      }
                      
                      if(!empty(Request::get('date'))){
                        $return = $return->whereDate('classes.created_at', '=', Request::get('date').'%');
                      }
        $return = $return->where('classes.is_deleted', '=', 0)
                         ->orderBy('classes.id', 'desc')
                         ->paginate(20);

        return $return;
    }
}
