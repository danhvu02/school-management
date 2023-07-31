<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ClassModel;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['getRecord'] = ClassModel::getRecord();
        $data['header_title'] = "Class List";
        return view('admin.class.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = "Add Class";
        return view('admin.class.add', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $class = new ClassModel();
        $class->name = trim($request->name);
        $class->status = trim($request->status);
        $class->created_by = Auth::user()->id;
        $class->save();

        return redirect(route('class.index'))->with('success', "Class successfully created");

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
        $data['getRecord'] = ClassModel::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['header_title'] = "Edit Class";
            return view('admin.class.edit', [
                'data' => $data
            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $class = ClassModel::getSingle($id);
        $class->name = trim($request->name);
        $class->status = trim($request->status);
        $class->save();

        return redirect(route('class.index'))->with('success', "Class successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $class = ClassModel::getSingle($id);
        $class->is_deleted = 1;
        $class->save();

        return redirect(route('class.index'))->with('success', "Class successfully deleted");
    }
}
