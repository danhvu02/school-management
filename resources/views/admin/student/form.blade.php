
@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>@if (isset($data['getRecord'])) Edit @else Add New @endif Student</h1>
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
                    <form action="{{route('student.update', $data['getRecord']->id)}}"  method="POST">
                    @method('put')
                @else
                    <form action="{{route('student.store')}}" method="POST" enctype="multipart/form-data">
                @endif
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>First Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $data['getRecord']->name ?? '') }}" placeholder="First Name" required>
                            <div style="color:red">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $data['getRecord']->last_name ?? '') }}" placeholder="Last Name" required>
                            <div style="color:red">{{ $errors->first('last_name') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Admission Number <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="admission_number" value="{{ old('admission_number', $data['getRecord']->admission_number ?? '') }}" placeholder="Admission Number" required>
                            <div style="color:red">{{ $errors->first('admission_number') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Roll Number</label>
                            <input type="text" class="form-control" name="roll_number" value="{{ old('roll_number', $data['getRecord']->roll_number ?? '') }}" placeholder="Roll Number">
                            <div style="color:red">{{ $errors->first('roll_number') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Class <span style="color: red;">*</span></label>
                            <select name="class_id" class="form-control">
                                <option value="" {{!isset($data['getRecord']) ? 'selected' : '' }} disabled>Select Class</option>
                                @foreach ($data['getClass'] as $value)
                                    <option value="{{$value->id}}" {{ old('class_id', $data['getRecord']->class_id ?? '') == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                @endforeach
                            </select>

                            <div style="color:red">{{ $errors->first('class_id') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gender <span style="color: red;">*</span></label>
                            <select name="gender" class="form-control">
                                <option value="" {{!isset($data['getRecord']) ? 'selected' : '' }} disabled>Select Gender</option>
                                <option value="Male" {{ old('gender', $data['getRecord']->gender ?? '') == 'Male' ? 'selected' : ''}}>Male</option>
                                <option value="Female" {{ old('gender', $data['getRecord']->gender ?? '') == 'Female' ? 'selected' : ''}}>Female</option>
                                <option value="Other" {{ old('gender', $data['getRecord']->gender ?? '') == 'Other' ? 'selected' : ''}}>Other</option>
                            </select>
                            <div style="color:red">{{ $errors->first('gender') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of Birth <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $data['getRecord']->date_of_birth ?? '') }}" required>
                            <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Caste</label>
                            <input type="text" class="form-control" name="caste" value="{{ old('caste', $data['getRecord']->caste ?? '') }}" placeholder="Caste">
                            <div style="color:red">{{ $errors->first('caste') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Religion</label>
                            <input type="text" class="form-control" name="religion" value="{{ old('caste', $data['getRecord']->religion ?? '') }}" placeholder="Religion">
                            <div style="color:red">{{ $errors->first('religion') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number', $data['getRecord']->mobile_number ?? '') }}" placeholder="Mobile Number">
                            <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Admission Date <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" name="admission_date" value="{{ old('admission_date', $data['getRecord']->admission_date ?? '') }}" required>
                            <div style="color:red">{{ $errors->first('admission_date') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Profile Picture</label>
                            <input type="file" class="form-control" name="profile_pic">
                            <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                            @if (!empty($data['getRecord'->getProfile()]))
                                <img src="{{$data['getRecord'->getProfile()]}}" style="height: 50; width: auto;"/>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Blood Group</label>
                            <input type="text" class="form-control" name="blood_group" value="{{ old('blood_group', $data['getRecord']->blood_group ?? '') }}" placeholder="Blood Group">
                            <div style="color:red">{{ $errors->first('blood_group') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Height</label>
                            <input type="text" class="form-control" name="height" value="{{ old('height', $data['getRecord']->height ?? '') }}" placeholder="Height">
                            <div style="color:red">{{ $errors->first('height') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Weight</label>
                            <input type="text" class="form-control" name="weight" value="{{ old('weight', $data['getRecord']->weight ?? '') }}" placeholder="Weight">
                            <div style="color:red">{{ $errors->first('weight') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status <span style="color: red;">*</span></label>
                            <select name="status" class="form-control">
                                <option value="" {{!isset($data['getRecord']) ? 'selected' : '' }} disabled>Select Gender</option>
                                <option value="0" {{ old('status', $data['getRecord']->status ?? '') == 0 ? 'selected' : ''}}>Active</option>
                                <option value="1" {{ old('status', $data['getRecord']->status ?? '') == 1 ? 'selected' : ''}}>Inactive</option>
                            </select>
                            <div style="color:red">{{ $errors->first('status') }}</div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="email">Email @unless (isset($data['getRecord']))<span style="color: red;">*</span>@endunless</label>
                        <input type="email" class="form-control" name="email" value="{{old('email', $data['getRecord']->email ?? '')}}" placeholder="Email" required>
                        <div style="color:red">{{ $errors->first('email') }}</div>
                      </div>
                      <div class="form-group">
                        <label for="password">Password <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Password" {{(!isset($data['getRecord']) ? 'required' : '' )}}>
                      </div>
                      @if (isset($data['getRecord']))
                        <p>Please add new password if you want to change.</p>
                      @endif

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
