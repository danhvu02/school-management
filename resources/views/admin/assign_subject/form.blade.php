
@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>@if (isset($data['getRecord'])) Edit Assigned @else Assign New @endif Subject</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

            <div class="card card-primary">
                @if(isset($data['getRecord']))
                    <form action="{{route('assign_subject.update', $data['getRecord']->id)}}"  method="POST">
                    @method('put')
                @else
                    <form action="{{route('assign_subject.store')}}" method="POST">
                @endif
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label>Class Name</label>
                        <select name="class_id" class="form-control" required>
                            <option value="" {{!isset($data['getRecord']) ? 'selected' : '' }} disabled>Select Class</option>
                            @foreach ($data['getClass'] as $class)
                                <option value="{{$class->id}}" {{ old('class_id', $data['getRecord']->class_id ?? '') == $class->id ? 'selected' : ''}}>{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Subject Name</label>
                        @foreach ($data['getSubject'] as $subject)
                            @if (isset($data['getRecord']))
                                @php
                                    $checked = "";
                                @endphp
                                @foreach ($data['getAssignedSubjectId'] as $subjectAssign)
                                    @if ($subjectAssign->subject_id == $subject->id)
                                        @php
                                            $checked = "checked";
                                        @endphp
                                    @endif

                                @endforeach
                            @endif

                            <div class="form-check">
                                <input {{isset($data['getRecord']) ? $checked : ''}} class="form-check-input" type="checkbox" value="{{$subject->id}}" id="flexCheckDefault" name="subject_id[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{$subject->name}}
                                </label>
                            </div>
                        @endforeach
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
                    <button type="submit" class="btn btn-primary">@if (isset($data['getRecord'])) Update @else Submit @endif</button>
                </div>
                </form>

            </div>

            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
