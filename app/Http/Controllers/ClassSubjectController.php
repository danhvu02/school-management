<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\ClassModel;
use App\Models\Subject;
use Illuminate\Http\Request;
use Auth;

class ClassSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['getRecord'] = ClassSubject::getRecord();
        $data['header_title'] = "Assigned Subject List";
        return view('admin.assign_subject.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = Subject::getSubject();
        $data['header_title'] = "Assign Subject";
        return view('admin.assign_subject.form', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!empty($request->subject_id)){
            foreach ($request->subject_id as $subject_id){
                $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } else {
                    $assignedSubject = new ClassSubject;
                    $assignedSubject->class_id = $request->class_id;
                    $assignedSubject->subject_id = $subject_id;
                    $assignedSubject->status = $request->status;
                    $assignedSubject->created_by = Auth::user()->id;
                    $assignedSubject->save();
                }

            }
            return redirect(route('assign_subject.index'))->with('success', "Subject is successfully assigned to class.");

        } else {
            return redirect()->back()->with('error', 'Due to some error please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassSubject $classSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['getRecord'] = ClassSubject::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['getAssignedSubjectId'] = ClassSubject::getAssignedSubjectId($data['getRecord']->class_id);
            $data['header_title'] = "Edit Assigned Subject";
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
            return view('admin.assign_subject.form', [
                'data' => $data

            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        ClassSubject::deleteSubject($request->class_id);

        if (!empty($request->subject_id)){
            foreach ($request->subject_id as $subject_id){
                $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } else {
                    $assignedSubject = new ClassSubject;
                    $assignedSubject->class_id = $request->class_id;
                    $assignedSubject->subject_id = $subject_id;
                    $assignedSubject->status = $request->status;
                    $assignedSubject->created_by = Auth::user()->id;
                    $assignedSubject->save();
                }
            }
        }
        return redirect(route('assign_subject.index'))->with('success', "Subject is successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classSubject = ClassSubject::getSingle($id);
        $classSubject->is_deleted = 1;
        $classSubject->save();

        return redirect(route('assign_subject.index'))->with('success', "Record successfully deleted");

    }

    public function edit_single($id){
        $data['getRecord'] = ClassSubject::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['header_title'] = "Edit Assigned Subject";
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
            return view('admin.assign_subject.edit_single', [
                'data' => $data

            ]);
        } else {
            abort(404);
        }
    }

    public function update_single($id, Request $request){
        $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id, $request->subject_id);
        if (!empty($getAlreadyFirst)){
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();
        } else {
            $assignedSubject = ClassSubject::getSingle($id);
            $assignedSubject->class_id = $request->class_id;
            $assignedSubject->subject_id = $request->subject_id;
            $assignedSubject->status = $request->status;
            $assignedSubject->save();
        }
        return redirect(route('assign_subject.index'))->with('success', "Subject is successfully updated.");

    }
}
