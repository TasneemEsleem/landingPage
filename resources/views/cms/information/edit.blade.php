@extends('cms.parent')
@section('title','Dashboard')
@section('lg_title','Edit information')
@section('main_title','information')
@section('sm_title','Edit information')
@section('content')

<div class="col-md-12">
  <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit information</h3>
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
          <input type="email" class="form-control" id="email" placeholder="Enter the email" value="{{$information->email}}">
        </div>
        </div>
        <div class="col-6">
        <div class="form-group">
          <label for="facebook">Facebook</label>
          <input type="text" class="form-control" id="facebook" placeholder="Enter the Facebook" value="{{$information->facebook}}">
        </div>
        </div>
      </div>
      <div class="row justify-content-start">
        <div class="col-6">
        <div class="form-group">
          <label for="email">City</label>
          <input type="text" class="form-control" id="city" placeholder="Enter the city" value="{{$information->city}}">
        </div>
        </div>
        <div class="col-6">
        <div class="form-group">
          <label for="location">location</label>
          <input type="text" class="form-control" id="location" placeholder="Enter the location" value="{{$information->location}}">
        </div>
        </div>
      </div>
        <div class="row justify-content-start">
        <div class="col-4">
        <div class="form-group">
          <label for="twitter">twitter</label>
          <input type="text" class="form-control" id="twitter" placeholder="Enter the twitter" value="{{$information->twitter}}">
        </div>
        </div>
        <div class="col-4">
        <div class="form-group">
          <label for="linkedIn">linkedIn</label>
          <input type="text" class="form-control" id="linkedIn" placeholder="Enter the linkedIn" value="{{$information->linkedIn}}">
        </div>
        </div>
        <div class="col-4">
        <div class="form-group">
          <label for="Instagram">Instagram</label>
          <input type="text" class="form-control" id="Instagram" placeholder="Enter the Instagram" value="{{$information->instagram}}">
        </div>
        </div>
        </div>
        <div class="form-group">
          <label>Phone</label>
          <input type="text" class="form-control" id="phone" placeholder="Enter the phone" value="{{$information->phone}}">
        </div>
        <div class="form-group">
              <label for="image">Image</label>
              <img class="card-img img-fluid mb-1" style="height:150px; width: 150px; " src="{{Storage::url($information->logo)}}" alt="image cap">
              <input type="file" class="form-control" id="logo" placeholder="image" value="{{old('logo')}}">
            </div>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="active"@if ($information->active) checked  
                      @endif >
          <label class="custom-control-label" for="active">Active</label>
        </div>
        <div class="card-footer">
          <button type="button" onclick="performUpdate('{{$information->id}}')" class="btn btn-primary">Save</button>
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
    formData.append('phone', document.getElementById('phone').value);
    formData.append('location', document.getElementById('location').value);
    formData.append('city', document.getElementById('city').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('facebook', document.getElementById('facebook').value);
    formData.append('twitter', document.getElementById('twitter').value);
    formData.append('linkedIn', document.getElementById('linkedIn').value);
    formData.append('Instagram', document.getElementById('Instagram').value);
    formData.append('active', document.getElementById('active').checked ? 1 : 0);
    if (document.getElementById('logo').files[0] != undefined) {
            formData.append('logo', document.getElementById('logo').files[0]);
        }
      formData.append('_method','PUT');
      axios.post('/cms/informations/{{$information->id}}', formData)
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