@extends('landing.parent')
@section('content')
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
    @endsection
    @section('script')
    <script>
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
                    window.location.href = '/page/contactus';
                })
                .catch(function(error) {
                    console.log(error.response);
                    toastr.error(error.response.data.message);
                });
        }
    </script>

  
        
    @endsection