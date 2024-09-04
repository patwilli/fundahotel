@extends('base')

@section('contenu')
<!-- slider -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/images/slider/slider-1.jpg" class="d-block w-100" alt="image here">
        </div>
        <div class="carousel-item">
            <img src="assets/images/slider/slider-2.jpg" class="d-block w-100" alt="image here">
        </div>
        <div class="carousel-item">
            <img src="assets/images/slider/slider-3.jpg" class="d-block w-100" alt="image here">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<section class="py-3 bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="main-heading text-white">Funda Hotel Booking</h4>
                <div class="underline bg-white mx-auto"></div>
                <p class="text-white">
                    Get the Best Price on booking your hotel rooms at Funda Hotel Booking.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- slider -->

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="main-heading">Book Rooms</h4>
                <div class="underline mb-0"></div>
                <hr class="my-0">
            </div>

            <div class="col-md-12 mt-4">
                <div class="row">
                    @if(count($rooms) > 0)
                    @foreach($rooms as $room)
                    <div class="col-md-4">
                        <a href="{{route('views', ['id' => $room->id])}}" class="text-decoration-none">
                            <div class="card-box">
                                <div class="roomimage">
                                    <img src="uploads/{{$room->room_image}}" class="" alt=" {{$room->room_name}}">
                                </div>
                                <div class="card-box-body">
                                    <h4 class="card-heading">{{$room->room_name}}
                                        <button class="btn btn-sm btn-primary float-end text-white">{{$room->price}} XAF</button>
                                    </h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @else
                    <h2 class="heading">No rooms found</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section bg-lightgray">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-3 text-center">
                <h4 class="main-heading">Our Testimonials</h4>
                <div class="underline mx-auto"></div>
                <p>
                    What people tell about our Funda Hotel Booking
                </p>
            </div>

            <div class="col-md-8">
                <div class="owl-carousel testimonials owl-theme">

                    <div class="item text-center">
                        <div class="testi-card">
                            <div class="testi-content">
                                <p>
                                    <i class="left-q-icon text-white fa fa-quote-left "> </i>
                                    I have been using their service a couple of time. They are one of the best hotel booking service provider in bangalore.
                                </p>
                                <h5 class="testi-title">Raju</h5>
                            </div>
                        </div>
                    </div>

                    <div class="item text-center">
                        <div class="testi-card">
                            <div class="testi-content">
                                <p>
                                    <i class="left-q-icon text-white fa fa-quote-left "> </i>
                                    I have been using their service a couple of time. They are one of the best hotel booking service provider in bangalore.
                                </p>
                                <h5 class="testi-title">Sahal SM</h5>
                            </div>
                        </div>
                    </div>

                    <div class="item text-center">
                        <div class="testi-card">
                            <div class="testi-content">
                                <p>
                                    <i class="left-q-icon text-white fa fa-quote-left "> </i>
                                    One of the best hotel booking service provider in bangalore
                                    One of the best hotel booking service provider in bangalore
                                </p>
                                <h5 class="testi-title">Muniraj</h5>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@section('footer-script')

<script>
    $(document).ready(function() {

        $('.testimonials').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })

    });
</script>

@endsection