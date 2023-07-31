@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Subject List</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{route('subject.create')}}" class="btn btn-primary">Add new subject</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Search Subject</h3>
                  </div>
                  <form action="" method="GET">
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-3">
                          <label for="name">Subject Name</label>
                          <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}" placeholder="Name">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="type">Subject Type</label>
                          <select name="type" class="form-control">
                            <option value="">Select Type</option>
                            <option {{ (Request::get('type') == 'Theory') ? 'selected' : '' }} value="Theory">Theory</option>
                            <option {{ (Request::get('type') == 'Practical') ? 'selected' : '' }} value="Practical">Practical</option>
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="date">Date</label>
                          <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}" placeholder="Date">
                        </div>
                        <div class="form-group col-md-3">
                          <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                          <a href="{{ route('class.index') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </form>
                </div>

            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Subject List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Subject Name</th>
                      <th>Subject Type</th>
                      <th>Status</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data['getRecord'] as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->type}}</td>
                        <td>
                          @if ($value->status == 0)
                            Active
                          @else
                            Inactive
                          @endif
                        </td>
                        <td>{{$value->created_by_name}}</td>
                        <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                        <td>
                            <a href="{{ route('subject.edit', $value->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('subject.delete', $value->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float: right;">
                  {!! $data['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
