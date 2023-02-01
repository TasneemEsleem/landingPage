@extends('landing.parent')
@section('content')
  <!-- team section start -->
  <div class="team_section layout_padding">
        <div class="container">
            <h1 class="choose_taital"><span>Our </span> <img src="{{asset('assets/images/icon-1.png')}}"> <span style="color: #1f1f1f">Team</span></h1>
            <p class="choose_text">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
            <div class="team_section_2 layout_padding">
                <div class="container">
                    @foreach ($teams as $team )
                    <div class="images_main_1">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="image_4"><img src="{{Storage::url($team->image)}}"></div>
                                <h6 class="follow_text">Follow Us</h6>
                                <div class="follow_social_icon">
                                    <ul>
                                        <li><a href="{{$team->facebook}}"><img src="{{asset('assets/images/fb-icon.png')}}"></a></li>
                                        <li><a href="{{$team->twitter}}"><img src="{{asset('assets/images/twitter-icon.png')}}"></a></li>
                                        <li><a href="{{$team->linkedIn}}"><img src="{{asset('assets/images/linkden-icon.png')}}"></a></li>
                                        <li><a href="{{$team->Instagram}}"><img src="{{asset('assets/images/instagram-icon.png')}}"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <h2 class="consectetur_text">{{$team->title}}</h2>
                                <p class="dummy_text">{{$team->description}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- team section start -->
@endsection