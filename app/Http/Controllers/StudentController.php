<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use Hash;
use Auth;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['getRecord'] = User::getStudent();
        $data['header_title'] = "Student List";
        return view('admin.student.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add New Student";
        return view('admin.student.form', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'weight' => 'max:10',
            'blood_group' => 'max: 10',
            'mobile_number' => 'max:15|min:8',
            'admission_number' => 'max: 50',
            'roll_number' => 'max: 50',
            'caste' => 'max: 50',
            'religion' => 'max: 50',
            'height' => 'max:10'
        ]);


        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);
        }

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file= $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move(public_path('upload/profile/'), $filename);

            $student->profile_pic = $filename;
        }

        /* if ($request->hasfile('profile_pic')){
            $filename = time().'.'.request()->profile_pic->getClientOriginalExtension();
            $path = public_path('uploads/profile/' . $filename);
            request()->profile_pic->move(public_path('uploads/profile/'), $filename);
            $oldFilename = $student->profile_pic;
            Storage::delete($oldFilename);

            $student->profile_pic = $filename;
        } */

        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->admission_date = trim($request->admission_date);
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();
        return redirect(route('student.index'))->with('success', "Student successfully created");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = "Edit Student";
            return view('admin.student.form', [
                'data' => $data
            ]);

        } else {
        abort (404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'weight' => 'max:10',
            'blood_group' => 'max: 10',
            'mobile_number' => 'max:15|min:8',
            'admission_number' => 'max: 50',
            'roll_number' => 'max: 50',
            'caste' => 'max: 50',
            'religion' => 'max: 50',
            'height' => 'max:10'
        ]);


        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);
        }

        if(!empty($request->file('profile_pic'))){
            if(!empty($student->getProfile())){
            unlink(public_path('upload/profile/'.$student->profile_pic));
            }

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file= $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move(public_path('upload/profile/'), $filename);

            $student->profile_pic = $filename;
        }

        /* if ($request->hasfile('profile_pic')){
            $filename = time().'.'.request()->profile_pic->getClientOriginalExtension();
            $path = public_path('uploads/profile/' . $filename);
            request()->profile_pic->move(public_path('uploads/profile/'), $filename);
            $oldFilename = $student->profile_pic;
            Storage::delete($oldFilename);

            $student->profile_pic = $filename;
        } */

        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->admission_date = trim($request->admission_date);
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if(!empty($request->password)){
            $student->password = Hash::make($request->password);
        }
        $student->user_type = 3;
        $student->save();
        return redirect(route('student.index'))->with('success', "Student successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
