@extends('base')

@section('contenu')
<div class="py-4 bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <a href="{{route('availability-room')}}"><button class="btn btn-info">Book now</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="main-heading">Check Room Availability</h4>
                <div class="underline mb-0"></div>
                <hr class="my-0">
            </div>
            <div class="col-md-12">
                <div class="card-box">
                    <div class="card-body">
                        <!-- Payment Modal -->
                        <div class="modal fade" id="CheckoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('effectiveReservation')}}" method="POST">
                                            @csrf
                                            @if(Auth::check())
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">User Name</label>
                                                        <h5 class="form-control">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">First Name</label>
                                                        <input type="text" class="form-control alphaonly" required name="fname">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Last Name</label>
                                                        <input type="text" class="form-control alphaonly" required name="lname">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Phone</label>
                                                        <input type="number" onblur="PhoneNumvalidate()" id="mobilenumber" class="form-control" required name="phone">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Email adress</label>
                                                        <input type="email" required class="form-control" name="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="">Choose Gender</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" value="Male" id="male">
                                                        <label class="form-check-label" for="male">
                                                            Male
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" value="Female" id="female">
                                                        <label class="form-check-label" for="female">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                            @endif

                                            <hr>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Room Price</label>
                                                    <h5 class="form-control">{{$room->price}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">No of Days</label>
                                                    <h5 class="form-control">{{$no_of_days}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Total Price</label>
                                                    <h5 class="form-control">{{$total_price}}</h5>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="" id="cashon" role="tabpanel" aria-labelledby="cashon-tab">
                                                            <div class="p-0">
                                                                <input type="hidden" name="bookroomid" value="{{$room->id}}">
                                                                <input type="hidden" name="checkin" value="{{$checkin}}">
                                                                <input type="hidden" name="checkout" value="{{$checkout}}">
                                                                <input type="hidden" name="totalprice" value="{{$total_price}}">

                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="confirm_book_btn" value="1" class="btn btn-primary">Confirm your Booking</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Payment Modal -->
                    @if($room)
                    <div class="row">
                        <div class="col-md-6 border-end">
                            <img src="uploads/royal.jpg" alt="" class="w-100">
                        </div>
                        <div class="col-md-6">


                            <h2 class="main-heading">Room is available</h2>
                            <h6 class="form-control bg-white"> Room: {{$room->room_name}}</h6>
                            <h6 class="form-control bg-white"> No of beds: {{$room->no_of_beds}}</h6>

                            <h6 class="form-control bg-white"> Price: {{$room->price}}</h6>
                            <h6 class="form-control bg-white"> Check In: {{$checkin}}</h6>
                            <h6 class="form-control bg-white"> Check Out: {{$checkout}}</h6>
                            <div class="text-end">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#CheckoutModal" class="btn btn-primary">Book Now</button>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <h2 class="heading">
                                All rooms of this Category are booked on the selected dates
                                <br>
                                <{{$checkin}} <br>
                                    <a href="all-rooms.php" class="btn btn-primary px-4 mt-2">Back</a>
                            </h2>
                        </div>
                    </div>
                    @endif
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
        $(".monthPicker").datepicker({
            dateFormat: 'MM yy',
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,

            onClose: function(dateText, inst) {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).val($.datepicker.formatDate('m/y', new Date(year, month, 1)));
            }
        });

        $(".monthPicker").focus(function() {
            $(".ui-datepicker-calendar").hide();
            $("#ui-datepicker-div").position({
                my: "center top",
                at: "center bottom",
                of: $(this)
            });
        });
    });
</script>

@endsection