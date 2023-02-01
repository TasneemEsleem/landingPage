@extends('landing.parent')
@section('content')
<div class="choose_section layout_padding">
      <div class="container">
        <h1 class="choose_taital"><span>Why </span> <img src="{{asset('assets/images/icon-1.png')}}"> <span style="color: #1f1f1f">Choose Us</span></h1>
        <p class="choose_text">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
        <div class="choose_section_2 layout_padding">
          <div class="row">
            <div class="col-lg-3 col-sm-6">
              <div class="choose_box">
                <h1 class="client_taital">{{$users}}+</h1>
                <h4 class="client_text">Our clients</h4>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="choose_box">
                <h1 class="client_taital">{{$subscribes}}+</h1>
                <h4 class="client_text">SubScribe clients</h4>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="choose_box">
                <h1 class="client_taital">{{$teams}}+</h1>
                <h4 class="client_text">Teams</h4>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="choose_box">
                <h1 class="client_taital">{{$contactus}}+</h1>
                <h4 class="client_text">User ContactUs</h4>
              </div>
            </div>
          </div>
          <div class="image_3"><img src="{{asset('assets/images/img-3.png')}}"></div>
          <div class="get_bt"><a href="#">Get A quote</a></div>
        </div>
      </div>
    </div>    
@endsection