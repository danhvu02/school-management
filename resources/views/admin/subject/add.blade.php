@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Add New Subject</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @include('admin.subject.form')
</div>
@endsection
