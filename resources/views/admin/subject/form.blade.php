<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <div class="card card-primary">
            @if(isset($data['getRecord']))
                <form action="{{route('subject.update', $data['getRecord']->id)}}"  method="POST">
                @method('put')
            @else
                <form action="{{route('subject.store')}}" method="POST">
            @endif
              {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Subject Name</label>
                  <input type="text" class="form-control" name="name" value="{{ old('name', $data['getRecord']->name ?? '') }}" placeholder="Class Name" required>
                </div>
                <div class="form-group">
                  <label for="type">Subject Type</label>
                  <select name="type" class="form-control" required>
                    <option value="" {{!isset($data['getRecord']) ? 'selected' : '' }} disabled>Select Type</option>
                    <option value="Theory" {{ old('type', $data['getRecord']->type ?? '') == 'Theory' ? 'selected' : ''}}>Theory</option>
                    <option value="Practical" {{ old('type', $data['getRecord']->type ?? '') == 'Practical' ? 'selected' : ''}}>Practical</option>
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
                <button type="submit" class="btn btn-primary">@if (isset($data['getRecord'])) Update @else Submit @endif</button>
              </div>
            </form>

          </div>

        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
