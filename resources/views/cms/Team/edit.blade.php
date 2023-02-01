@extends('cms.parent')
@section('title','Dashboard')
@section('lg_title','Edit Team')
@section('main_title','Team')
@section('sm_title','Edit Team')
@section('content')

<div class="col-md-12">
  <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Team</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create-form">
      @csrf
      <div class="card-body">
      <div class="row justify-content-start">
        <div class="col-6">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" placeholder="Enter the Title" value="{{$team->title}}">
        </div>
        </div>
        <div class="col-6">
        <div class="form-group">
          <label for="title">Facebook</label>
          <input type="text" class="form-control" id="facebook" placeholder="Enter the Facebook" value="{{$team->facebook}}">
        </div>
        </div>
      </div>
        <div class="row justify-content-start">
        <div class="col-4">
        <div class="form-group">
          <label for="twitter">twitter</label>
          <input type="text" class="form-control" id="twitter" placeholder="Enter the twitter" value="{{$team->twitter}}">
        </div>
        </div>
        <div class="col-4">
        <div class="form-group">
          <label for="linkedIn">linkedIn</label>
          <input type="text" class="form-control" id="linkedIn" placeholder="Enter the linkedIn" value="{{$team->linkedIn}}">
        </div>
        </div>
        <div class="col-4">
        <div class="form-group">
          <label for="Instagram">Instagram</label>
          <input type="text" class="form-control" id="Instagram" placeholder="Enter the Instagram" value="{{$team->Instagram}}">
        </div>
        </div>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" rows="3" id="description" placeholder="Description" style="height: 120px;">{{$team->description}}</textarea>
        </div>
        <div class="form-group">
              <label for="image">Image</label>
              <img class="card-img img-fluid mb-1" style="height:150px; width: 150px; " src="{{Storage::url($team->image)}}" alt="image cap">
              <input type="file" class="form-control" id="image" placeholder="image" value="{{old('image')}}">
            </div>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="active"@if ($team->active) checked  
                      @endif >
          <label class="custom-control-label" for="active">Active</label>
        </div>
        <div class="card-footer">
          <button type="button" onclick="performUpdate('{{$team->id}}')" class="btn btn-primary">Save</button>
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
    formData.append('facebook', document.getElementById('facebook').value);
    formData.append('twitter', document.getElementById('twitter').value);
    formData.append('linkedIn', document.getElementById('linkedIn').value);
    formData.append('Instagram', document.getElementById('Instagram').value);
    formData.append('active', document.getElementById('active').checked ? 1 : 0);
    if (document.getElementById('image').files[0] != undefined) {
            formData.append('image', document.getElementById('image').files[0]);
        }
      formData.append('_method','PUT');
      axios.post('/cms/teams/{{$team->id}}', formData)
      .then(function(response) {
        console.log(response);
        toastr.success(response.data.message);
        //  document.getElementById('create-form').reset();
        window.location.href = '/cms/teams';
      })
      .catch(function(error) {
        console.log(error.response);
        toastr.error(error.response.data.message);
      });
  }
</script>
@endsection