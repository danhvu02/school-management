<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['getRecord'] = Subject::getRecord();
        $data['header_title'] = "Subject List";
        return view('admin.subject.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = "Add Subject";
        return view('admin.subject.add', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subject = new Subject();
        $subject->name = trim($request->name);
        $subject->type = trim($request->type);
        $subject->status = trim($request->status);
        $subject->created_by = Auth::user()->id;
        $subject->save();

        return redirect(route('subject.index'))->with('success', "Class successfully created");
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
        $data['getRecord'] = Subject::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['header_title'] = "Edit Subject";
            return view('admin.subject.edit', [
                'data' => $data

            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::getSingle($id);
        $subject->name = trim($request->name);
        $subject->type = trim($request->type);
        $subject->status = trim($request->status);
        $subject->save();

        return redirect(route('subject.index'))->with('success', "Subject successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::getSingle($id);
        $subject->is_deleted = 1;
        $subject->save();

        return redirect(route('subject.index'))->with('success', "Subject successfully deleted");
    }
}
