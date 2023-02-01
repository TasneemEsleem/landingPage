@extends('cms.parent')
@section('title','Dashboard')
@section('lg_title','Create aboutus')
@section('main_title','aboutus')
@section('sm_title','Create aboutus')
@section('content')

<div class="col-md-12">
  <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create aboutus</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create-form">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title"  value="{{$aboutu->title}}">
        </div>
    
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" rows="3" id="description" placeholder="Description" style="height: 120px;">{{$aboutu->description}}</textarea>
        </div>
        <div class="form-group">
              <label for="image">Image</label>
              <img class="card-img img-fluid mb-1" style="height:150px; width: 150px; " src="{{Storage::url($aboutu->image)}}" alt="image cap">
              <input type="file" class="form-control" id="image" placeholder="image" value="{{old('image')}}">
            </div>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="active"@if ($aboutu->active) checked  
                      @endif >
          <label class="custom-control-label" for="active">Active</label>
        </div>
        <div class="card-footer">
          <button type="button" onclick="performUpdate('{{$aboutu->id}}')" class="btn btn-primary">Save</button>
        </div>
    </form>
  </div>
</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>
   function performUpdate(id) {
    var formData = new FormData();
    formData.append('title', document.getElementById('title').value);
    formData.append('description', document.getElementById('description').value);
    formData.append('active', document.getElementById('active').checked ? 1 : 0);
    if (document.getElementById('image').files[0] != undefined) {
            formData.append('image', document.getElementById('image').files[0]);
        }
      formData.append('_method','PUT');
      axios.post('/cms/aboutus/{{$aboutu->id}}', formData)
      .then(function(response) {
        console.log(response);
        toastr.success(response.data.message);
        //  document.getElementById('create-form').reset();
        window.location.href = '/cms/aboutus';
      })
      .catch(function(error) {
        console.log(error.response);
        toastr.error(error.response.data.message);
      });
  }
</script>
@endsection