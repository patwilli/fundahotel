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
                <div class="card-box mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 border-end">
                                <div class="">
                                    <img src="uploads/{{$room->room_image}}" class="w-100" alt="{{$room->room_name}}">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mt-2">
                                    <form action="{{route('confirm')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="roomid" value="{{$room->id}}">
                                        <div class="row">
                                            <div class="col-md-8 col-9">
                                                <label class="card-label">Room Name:</label>
                                                <h4 class="card-name">{{$room->room_name}}</h4>
                                            </div>
                                            <div class="col-md-4 col-3 text-end">
                                                <label class="card-label">Price:</label>
                                                <h4 class="card-name"> {{$room->price}} XAF</h4>
                                            </div>
                                            <div class="col-md-12">
                                                <hr class="my-2">
                                                <label class="card-label">Description:</label>
                                                <div class="card-description">
                                                    {!! $room->description !!}
                                                </div>
                                                <hr class="my-2">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <input type="text" name="room_id" id="" value="{{$room->id}}" hidden>
                                            <div class="col-md-4">
                                                <label class="card-label">Check In:</label>
                                                <input type="date" id="checkin" value="{{$today}}" class="checkinclass form-control" name="checkin">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="card-label">Check out:</label>
                                                <input type="date" id="checkout" value="{{$today}}" class="checkoutclass form-control" name="checkout">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="card-label">Check Availability</label>
                                                <button type="submit" class="btn btn-primary w-100">Check Now</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="heading">Invalid Room Id</h2>
                        </div>
                    </div>
                </div>
            </div> -->

            </div>
        </div>
    </div>
</section>


@endsection

@section('footer-script')


<script>
    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        $('#checkin').attr('min', maxDate);
        $('#checkout').attr('min', maxDate);
    });

    $('#checkin').blur(function(e) {
        e.preventDefault();

        var cin = $(this).val();
        var maxDate = cin;
        $('#checkout').attr('min', maxDate);
        $('.checkoutclass').val(maxDate);
    });
</script>

@endsection