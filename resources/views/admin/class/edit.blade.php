@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Edit Class</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="card card-primary">
              <form action="{{route('class.update', $data['getRecord']->id)}}"  method="POST">
                {{ csrf_field() }}
                @method('PUT')

                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Class Name</label>
                    <input type="text" class="form-control" value="{{ $data['getRecord']->name }}" name="name" placeholder="Class Name" required>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                      <option {{ ($data['getRecord']->status == 0) ? 'selected' : '' }} value="0">Active</option>
                      <option {{ ($data['getRecord']->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
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
    <!-- /.content -->
  </div>
@endsection
