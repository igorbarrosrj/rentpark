@extends('layouts.user')

@section('content')

    <!--Section_Content_First_Start-->
    <section>

        <div class="bg-img">

            <div class="bg_content">

                <h1>Find parking in seconds</h1>

                <p>Choose from millions of available spaces, or reserve your space in advance. Join over 2.5 million drivers enjoying easy parking.</p>

                <div class="click_option">
                    <span id="demo1" class="click_option1" onclick="myFunction1()">HOURLY / DAILY</span>
                    <span id="demo" class="click_option2" onclick="myFunction()">MONTHLY</span>
                </div>

                <form>
                    <div class="form-group">
                        <small>PARKING AT</small>
                        <input class="form-control input-lg" id="inputl" type="text" placeholder="Where do you want to park?">
                        <i class="material-icons">&#xe55c;</i>
                    </div>
                    
                    <div class="input-group">
                        <input type="text1" class="form-control_1" placeholder="Select a date & time"><i class="fas fa-angle-down"></i>
                        <small aria-hidden="true">ARRIVING ON</small>
                        <input type="text2" class="form-control_2" placeholder="Select a date & time">
                        
                        <div class="i">
                            <i class="fas fa-angle-down"></i>
                        </div>

                        <small class="small">LEAVING ON</small>
                        <button type="click_option_btn" class="btn btn-primary btn-lg btn-block">Show parking spaces</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!--Section_Content_First_end-->

    <!--Section_Content_Second_Start-->
    <section class="index">
        <div class="container">
            <h1>Parking made easy</h1>
            <div class="row justify-content-md-center">
                <div class="col">
                    <div class="circle">
                        <img src="{{ asset('user-assets/img/2.png') }}">
                        <hr>
                    </div>

                    <div>
                        <strong>Wherever, whenever</strong>
                    </div>

                    <div>
                        <small><p>Choose from millions of spaces across <span>the UK</span></p></small>
                        <small><p>Find your best option for every car <span>journey</span></p></small>
                    </div>

                </div>

                <div class="col">
                    <div class="circle">
                        <img src="{{ asset('user-assets/img/3.png') }}">
                        <hr>
                    </div>
                            
                    <div>
                        <strong><span>Peace of mind</span></strong>
                    </div>
                        
                    <div>
                        <small><p>View information on availability,price <span>and restrictions</span></p></small>
                        <small><p>Reserve in advance at over 45,000+ locations</p></small>
                    </div>
                </div>
                    
                <div class="col">
                    <div class="circle">
                        <img src="{{ asset('user-assets/img/4.png') }}">
                    </div>
                        
                    <div>
                        <strong>Seamless experience</strong>
                    </div>
                        
                    <div>
                        <small><p>Pay for JustPark spaces via the app or website</p></small>
                        <small><p>Follow easy directions and access instructions</p></small>
                    </div>
                </div>
            </div>
        </div>
    </section>      

    <!--Section_Content_Second_end-->

    <!--Section_Content_Third_Start-->
    <section class="bg-img_first">
        <div class="bg_content_first">
            <h2>Download the <span>UK's favourite</span> parking app</h2>

            <p>Rated 5 stars with an average satisfaction rating of 96%, JustPark is the UK’s favourite 
            parking service. But don’t just take our word for it – check out some of the latest customer
            reviews below for our London parking spaces.</p><br>

            <p class="p1">Enter your mobile number below to receive a one-time text message with a link to
            download the free JustPark app.</p>

            <input type="textarea" placeholder="Enter your mobile number" ><button class="index_btn" align="center">Send Link</button>

            <p class="p2">OR DOWNLOAD FROM:</p>

            <img class="favicon_img" src="{{ asset('user-assets/img/apple.svg') }}"><img class="favicon_img" src="{{ asset('user-assets/img/google.svg') }}">
        </div>
    </section>

    <!--Section_Content_Third_end-->

    <!--Section_Content_Four_Start-->
    <section class="bg-img_second">

        <div class="bg_content_second">

            <h2>Rent out your parking space</h2>

            <p>Make easy tax free money by renting out your parking space. It‘s free 
            to list and only takes a few minutes to get up and running.</p>

            <button type="submit_btn1">Learn how to earn today</button>
        </div>
    </section>
        
    <!--Section_Content_Four_end-->

    <!--Section_Slider_Start-->
    <section class="sliderhead">
        <h2>What <span>users</span> are saying</h2>

        <p>Don’t just take our word for it – check out some of the latest</p> 

        <p>customer reviews for our London parking spaces</p>
    </section>

    <section class="center slider">
        <div>
            <div class="slidertop">
                <p>Simple and easy-to-use app, perfect for my commute into work.Saves on stress of having to find a space in the morning in such a difficult area to find parking.
                </p>
            </div>
            
            <img class="sliderimg" src="{{ asset('user-assets/img/s1.jpg') }}">
            
            <div class="sliderbottom">
                <h6>Gemma T</h6>
                <p>Marriot Bristol Royal Car Park, Bristol</p>
                <span><i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i></span>
            </div>
        </div>

        <div>
            <div class="slidertop">
                <p>Simple and easy-to-use app, perfect for my commute into work.Saves on stress of having to find a space in the morning in such a difficult area to find parking.
                </p>
            </div>

            <img class="sliderimg" src="{{ asset('user-assets/img/s2.jpg') }}">

            <div class="sliderbottom">
                <h6>Carol N</h6>
                <p>Marriot Bristol Royal Car Park, Bristol
                </p>
                <span><i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i></span>
            </div>
        </div>

        <div>
            <div class="slidertop">
                <p>Simple and easy-to-use app, perfect for my commute into work.Saves on stress of having to find a space in the morning in such a difficult area to find parking.
                </p>
            </div>

            <img class="sliderimg" src="{{ asset('user-assets/img/s3.jpg') }}">

            <div class="sliderbottom">
                <h6>Carol N</h6>
                <p>Marriot Bristol Royal Car Park, Bristol
                </p>
                <span><i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i></span>
            </div>
        </div>

        <div>
            <div class="slidertop">
                <p>Simple and easy-to-use app, perfect for my commute into work.Saves on stress of having to find a space in the morning in such a difficult area to find parking.
                </p>
            </div>  

            <img class="sliderimg" src="{{ asset('user-assets/img/s4.jpg') }}">

            <div class="sliderbottom">
                <h6>Carol N</h6>
                <p>Marriot Bristol Royal Car Park, Bristol
                </p>
                <span><i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i></span>
            </div>
        </div>

        <div>   
            <div class="slidertop">
                <p>Simple and easy-to-use app, perfect for my commute into work.Saves on stress of having to find a space in the morning in such a difficult area to find parking.
                </p>
            </div>

            <img class="sliderimg" src="{{ asset('user-assets/img/s5.png') }}">

            <div class="sliderbottom">
                <h6>Carol N</h6>
                <p>Marriot Bristol Royal Car Park, Bristol
                </p>
                <span><i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i></span>
            </div>
        </div>

        <div>   
            <div class="slidertop">
                <p>Simple and easy-to-use app, perfect for my commute into work.Saves on stress of having to find a space in the morning in such a difficult area to find parking.
                </p>
            </div>

            <img class="sliderimg" src="{{ asset('user-assets/img/s6.png') }}">
            
            <div class="sliderbottom">
                <h6>Carol N</h6>
                <p>Marriot Bristol Royal Car Park, Bristol
                </p>
                <span><i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i></span>
            </div>
        </div>
    </section>

    <!--Section_Slider_end-->

    <!--Section_Content_Fifth_Start-->

    <section class="bg-img_third">
        <div class="bg_content_third">
            <h3>Car park management</h3>
            <p>Maximise yield from underused car parks and vacant land, or transform payments with the UK’s favourite parking app.
            </p>
            <button type="submit_btn2">Learn about our solution</button>
        </div>
    </section>

    <!--Section_Content_Fifth_end-->


@endsection

{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 --}}