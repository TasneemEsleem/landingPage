@extends('cms.parent')
@section('title','Dashboard')
@section('lg_title','Create Slider')
@section('main_title','Slider')
@section('sm_title','Create Slider')
@section('content')

<div class="col-md-12">
  <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Slider</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create-form">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="title_one">First Title</label>
          <input type="text" class="form-control" id="title_one" placeholder="Enter the First Title" value="{{old('title_one')}}">
        </div>
        <div class="form-group">
          <label for="title_two">Second Title</label>
          <input type="text" class="form-control" id="title_two" placeholder="Second Tilte" value="{{old('title_two')}}">
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" rows="3" id="description" placeholder="Description" style="height: 120px;"></textarea>
        </div>
        <div class="form-group">
              <label for="main_image">Image</label>
              <input type="file" class="form-control" id="image" placeholder="image" value="{{old('image')}}">
            </div>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="active">
          <label class="custom-control-label" for="active">Active</label>
        </div>
        <div class="card-footer">
          <button type="button" onclick="performStore()" class="btn btn-primary">Save</button>
        </div>
    </form>
  </div>
</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>
  function performStore() {
    var formData = new FormData();
    formData.append('title_one', document.getElementById('title_one').value);
    formData.append('title_two', document.getElementById('title_two').value);
    formData.append('description', document.getElementById('description').value);
    formData.append('active', document.getElementById('active').checked ? 1 : 0);
    if (document.getElementById('image').files[0] != undefined) {
            formData.append('image', document.getElementById('image').files[0]);
        }
    axios.post('/cms/sliders', formData)
      .then(function(response) {
        console.log(response);
        toastr.success(response.data.message);
        //  document.getElementById('create-form').reset();
        window.location.href = '/cms/sliders';
      })
      .catch(function(error) {
        console.log(error.response);
        toastr.error(error.response.data.message);
      });
  }
</script>
@endsection