@extends('landing.parent')
@section('content')
 <!-- about section start -->
 <div class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div><img src="{{Storage::url($aboutus->image)}}" class="image_2"></div>
                </div>
                <div class="col-md-6">
                    <h1 class="services_taital"><span>About </span> <img src="{{asset('assets/images/icon-1.png')}}"> <span style="color: #1f1f1f">Cleaning</span></h1>
                    <p class="ipsum_text">{{$aboutus->description}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- about section end -->



@endsection