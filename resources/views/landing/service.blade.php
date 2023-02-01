@extends('landing.parent')
@section('content')
<!-- services section start -->
<div class="services_section layout_padding">
        <div class="container">
            <h1 class="services_taital"><span>Our</span> <img src="{{asset('assets/images/icon-1.png')}}"> <span style="color: #1f1f1f">Services</span></h1>
            <p class="services_text">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
            <div id="main_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="services_section_2 layout_padding">
                            <div class="row">
                                @foreach ( $services as $service )
                                <div class="col-md-6">
                                    <div class="box_section">
                                        <div class="tiles" style="margin-left:200px;"><img src="{{Storage::url($service->image)}}" alt="NotFount"></div>
                                        <h3 class="tile_text">{{$service->title}}</h3>
                                        <p class="lorem_text">{{$service->description}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- services section start -->



@endsection