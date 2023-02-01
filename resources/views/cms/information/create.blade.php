@extends('cms.parent')
@section('title','Dashboard')
@section('lg_title','Create information')
@section('main_title','information')
@section('sm_title','Create information')
@section('content')

<div class="col-md-12">
  <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create information</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create-form">
      @csrf
      <div class="card-body">
      <div class="row justify-content-start">
        <div class="col-6">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Enter the email" value="{{old('email')}}">
        </div>
        </div>
        <div class="col-6">
        <div class="form-group">
          <label for="title">Facebook</label>
          <input type="text" class="form-control" id="facebook" placeholder="Enter the Facebook" value="{{old('facebook')}}">
        </div>
        </div>
      </div>
      <div class="row justify-content-start">
        <div class="col-6">
        <div class="form-group">
          <label for="email">City</label>
          <input type="text" class="form-control" id="city" placeholder="Enter the city" value="{{old('city')}}">
        </div>
        </div>
        <div class="col-6">
        <div class="form-group">
          <label for="location">location</label>
          <input type="text" class="form-control" id="location" placeholder="Enter the location" value="{{old('location')}}">
        </div>
        </div>
      </div>
        <div class="row justify-content-start">
        <div class="col-4">
        <div class="form-group">
          <label for="twitter">twitter</label>
          <input type="text" class="form-control" id="twitter" placeholder="Enter the twitter" value="{{old('twitter')}}">
        </div>
        </div>
        <div class="col-4">
        <div class="form-group">
          <label for="linkedIn">linkedIn</label>
          <input type="text" class="form-control" id="linkedIn" placeholder="Enter the linkedIn" value="{{old('linkedIn')}}">
        </div>
        </div>
        <div class="col-4">
        <div class="form-group">
          <label for="Instagram">Instagram</label>
          <input type="text" class="form-control" id="Instagram" placeholder="Enter the Instagram" value="{{old('Instagram')}}">
        </div>
        </div>
        </div>
        <div class="row justify-content-start">
        <div class="col-6">
        <div class="form-group">
          <label>Phone</label>
          <input type="text" class="form-control" id="phone" placeholder="Enter the phone" value="{{old('phone')}}">
        </div>
        </div>
        <div class="col-6">
        <div class="form-group">
              <label for="logo">Logo</label>
              <input type="file" class="form-control" id="logo" placeholder="image" value="{{old('image')}}">
            </div>
        </div>
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
    formData.append('email', document.getElementById('email').value);
    formData.append('location', document.getElementById('location').value);
    formData.append('city', document.getElementById('city').value);
    formData.append('phone', document.getElementById('phone').value);
    formData.append('facebook', document.getElementById('facebook').value);
    formData.append('twitter', document.getElementById('twitter').value);
    formData.append('linkedIn', document.getElementById('linkedIn').value);
    formData.append('Instagram', document.getElementById('Instagram').value);
    formData.append('active', document.getElementById('active').checked ? 1 : 0);
    if (document.getElementById('logo').files[0] != undefined) {
            formData.append('logo', document.getElementById('logo').files[0]);
        }
    axios.post('/cms/informations', formData)
      .then(function(response) {
        console.log(response);
        toastr.success(response.data.message);
        //  document.getElementById('create-form').reset();
        window.location.href = '/cms/informations';
      })
      .catch(function(error) {
        console.log(error.response);
        toastr.error(error.response.data.message);
      });
  }
</script>
@endsection