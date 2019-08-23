@extends('layouts.user') 

@section('content')

  <section class="single_host">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">

                    <img class="img" src="{{ asset('user-assets/img/team2.jpg') }}" alt="No Photo">

                    <p class="figure_text">RESERVABLE</p>

                    <img class="reservable_img" src="{{ asset('user-assets/img/reservable.svg') }} " alt="No Photo">

                    <p class="p">Space Name:<a href="#">Banglore</a></p>

                    <p class="p">Description:</p>

                    <p class="Description">*This Car Park may be inaccessible between 4am Saturday the 3rd of August and 10pm Sunday 4th of August due to the Prudential Ride London. We advise you check your route for road closures before booking.</p>

                    <h2 class="h2"><span class="span">Car Park</span> on <a href="!#"><c class="loc">Bloomsbury Square, WC1A</c></a></h2>

                    <span class="i"><i class="fa fa-star checked"></i>

                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>

                        <b class="b">(3,376)</b>
                    </span>

                    <p class="p"><a href="#">Available Spaces:  <b>5</b></a></p>
                    <p class="p"><a href="#">Per Hour:  <b>$10</b></a></p>

                </div>
                <div class="col-sm-5 other">
                    <form>
                        <div class="form-row">
                            <div class="col">
                                <input type="text6" class="form-control" placeholder="Check In"><img src="{{ asset('user-assets/img/dropdown.svg') }}">
                            </div>

                            <div class="col">
                                <input type="text7" class="form-control" placeholder="Check Out"><img class="drop_img" src="{{ asset('user-assets/img/dropdown.svg') }} ">
                            </div>
                        </div>
                    </form>

                        <p>Payment mode: COD</p>
                        
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">Terms & Condition
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--Section_end-->

@endsection