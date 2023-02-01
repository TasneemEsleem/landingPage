<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Capiclean</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <!-- fevicon -->
    <link rel="icon" href="{{asset('assets/images/fevicon.png')}}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/jquery.mCustomScrollbar.min.css')}}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
  
</head>

<body>
    <!--header section start -->
    <div class="header_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo"><a href="index.html"><img src="{{Storage::url($information->logo)}}"></a></div>
                </div>
                <div class="col-md-9">
                    <div class="menu_text">
                        <ul>
                            <div class="togle_3">
                                <div class="menu_main">
                                    <div class="padding_left0"><a href="#">Register</a>
                                        <span class="padding_left0"><a href="#">Login</a></span>
                                    </div>
                                </div>
                                <div class="shoping_bag"><img src="{{asset('assets/images/search-icon.png')}}"></div>
                            </div>
                            <div id="myNav" class="overlay">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                <div class="overlay-content">
                                    <a href="{{route('home')}}">Home</a>
                                    <a href="{{route('page.service')}}">Services</a>
                                    <a href="{{route('page.about')}}">About</a>
                                    <a href="{{route('choose.index')}}">Choose</a>
                                    <a href="{{route('page.Team')}}">Team</a>
                                    <a href="{{route('page.contactus')}}">Contact Us</a>
                                </div>
                            </div>
                            <span class="navbar-toggler-icon"></span>
                            <span onclick="openNav()"><img src="{{asset('assets/images/toggle-icon.png')}}" class="toggle_menu"></span>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner section start -->
        <div class="banner_section layout_padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <h1 class="banner_taital">{{$slider->title_one}}</h1>
                        <h1 class="banner_taital_1">{{$slider->title_two}}</h1>
                        <p class="banner_text">{{$slider->description}}</p>
                        <div class="contact_bt"><a href="{{route('page.contactus')}}">CONTACT US<span class="contact_padding"><img src="{{asset('assets/images/contact-icon.png')}}"></span></a></div>
                    </div>
                    <div class="col-sm-2">
                        <div class="play_icon"><a href="#"><img src="{{asset('assets/images/play-icon.png')}}"></a></div>
                    </div>
                    <div class="col-sm-5">
                        <div><img src="{{Storage::url($slider->image)}}" class="image_1"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner section end -->
    </div>
    <!-- header section end -->
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
                <div class="contact_bt_1"><a href="{{route('page.service')}}">READ MORE<span class="contact_padding"><img src="{{asset('assets/images/contact-icon1.png')}}"></span></a></div>

            </div>
        </div>
    </div>
    <!-- services section start -->
    <!-- about section start -->
    <div class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div><img src="{{Storage::url($aboutus->image)}}" class="image_2"></div>
                </div>
                <div class="col-md-6">
                    <h1 class="services_taital"><span>About </span> <img src="{{asset('assets/images/icon-1.png')}}"> <span style="color: #1f1f1f">Cleaning</span></h1>
                    <p class="ipsum_text">{{  \Illuminate\Support\Str::limit($aboutus->description, 100) }}
                    </p>
                    <div class="contact_bt_1"><a href="{{route('page.about')}}">READ MORE<span class="contact_padding"><img src="{{asset('assets/images/contact-icon1.png')}}"></span></a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- about section end -->
    <!-- choose section start -->
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
                <h1 class="client_taital">{{$team}}+</h1>
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
    <!-- choose section end -->
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
    <!-- newsletter section start -->
    <div class="newsletter_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="newsletter_text">Newsletter</h1>
                    <p class="tempor_text">Tempor incididunt ut labore et dolore magna aliqua</p>
                </div>
                <div class="col-md-6">
                    <div class="mail_bt_main">
                        <input type="email" class="mail_text" placeholder="ENTER YOUR MAIL" id="email" name="Enter Tour Mail">
                        <div class="subscribe_bt"> <button type="button" onclick="performStoreSubScribe()" style="background-color: #282828; color: white;">Send</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- newsletter section end -->
    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="footer_main">
                <div class="footer_left">
                    <h1 class="contact_taital"><span>Contact </span> <img src="{{asset('assets/images/icon-2.png')}}"> <span>Us</span></h1>
                </div>
                <div class="footer_left">
                    <div class="location_text"><a href="#"><img src="{{asset('assets/images/map-icon.png')}}"><span class="padding_left_15">{{$information->city}},{{$information->location}}</span></a></div>
                </div>
                <div class="footer_left">
                    <div class="location_text"><a href="#"><img src="{{asset('assets/images/call-icon.png')}}"><span class="padding_left_15">{{$information->phone}}</span></a></div>
                </div>
                <div class="footer_left">
                    <div class="location_text"><a href="#"><img src="{{asset('assets/images/map-icon.png')}}"><span class="padding_left_15">{{$information->email}}</span></a></div>
                </div>
            </div>
            <div class="contact_section">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mail_section">
                            <input type="text" class="email_text" placeholder="Name" id="name" name="Name">
                            <input type="text" class="email_text" placeholder="Email" id="email" name="Email">
                            <input type="text" class="email_text" placeholder="Phone Number" id="phone" name="Phone Number">
                            <textarea class="massage_text" placeholder="Message" rows="5" id="message" name="Message"></textarea>
                            <div class="send_bt">
                                <!-- <a href="#">send</a> -->
                                <button type="button" onclick="performStore()" class="btn btn-success">Send</button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="map_main">
                            <div class="map-responsive">
                                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q={{$information->city}}+{{$information->location}}" width="600" height="280" frameborder="0" style="border:0; width: 100%;" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="social_icon">
                            <ul>
                                <li><a href="{{$information->facebook}}"><img src="{{asset('assets/images/fb-icon1.png')}}"></a></li>
                                <li><a href="{{$information->twitter}}"><img src="{{asset('assets/images/twitter-icon1.png')}}"></a></li>
                                <li><a href="{{$information->linkedIn}}"><img src="{{asset('assets/images/linkden-icon1.png')}}"></a></li>
                                <li><a href="{{$information->instagram}}"><img src="{{asset('assets/images/instagram-icon1.png')}}"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">Copyright 2020 All Right Reserved By <a href="https://html.design">Free html Templates</a></p>
        </div>
    </div>
    <!-- copyright section end -->
    <!-- Javascript files-->
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-3.0.0.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin.js')}}"></script>
    <!-- sidebar -->
    <script src="{{asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <!-- javascript -->
    <script src="{{asset('assets/js/owl.carousel.js')}}"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });

            $(".zoom").hover(function() {

                $(this).addClass('transition');
            }, function() {

                $(this).removeClass('transition');
            });
        });
    </script>
    <script>
        function openNav() {
            document.getElementById("myNav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }
    </script>
    <script>
        function performStoreSubScribe() {
            var formData = new FormData();
            formData.append('email', document.getElementById('email').value);
            axios.post('/subscribe', formData)
                .then(function(response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = '/';
                })
                .catch(function(error) {
                    console.log(error.response);
                    toastr.error(error.response.data.message);
                });
        }

        function performStore() {
            var formData = new FormData();
            formData.append('email', document.getElementById('email').value);
            formData.append('phone', document.getElementById('phone').value);
            formData.append('name', document.getElementById('name').value);
            formData.append('message', document.getElementById('message').value);
            axios.post('/contactus', formData)
                .then(function(response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    //  document.getElementById('create-form').reset();
                    window.location.href = '/';
                })
                .catch(function(error) {
                    console.log(error.response);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
</body>

</html>