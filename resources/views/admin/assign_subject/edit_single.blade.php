
@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1> Edit Single Assigned Subject</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

            <div class="card card-primary">
                <form action="{{route('assign_subject.update_single', $data['getRecord']->id)}}"  method="POST">
                @method('put')

                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label>Class Name</label>
                        <select name="class_id" class="form-control" required>
                            <option value="" disabled>Select Class</option>
                            @foreach ($data['getClass'] as $class)
                                <option value="{{$class->id}}" {{ old('class_id', $data['getRecord']->class_id ?? '') == $class->id ? 'selected' : ''}}>{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Subject Name</label>
                        <select name="subject_id" class="form-control" required>
                            <option value="" disabled>Select Subject</option>
                            @foreach ($data['getSubject'] as $subject)
                                <option value="{{$subject->id}}" {{ old('subject_id', $data['getRecord']->subject_id ?? '') == $subject->id ? 'selected' : ''}}>{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="0" {{ old('status', $data['getRecord']->status ?? '') == 0 ? 'selected' : ''}}>Active</option>
                            <option value="1" {{ old('status', $data['getRecord']->status ?? '') == 1 ? 'selected' : ''}}>Inactive</option>
                        </select>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>

            </div>

            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
