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
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="main-heading">Book Rooms</h4>
                    </div>
                    <div class="col-md-6">
                        <!-- Formulaire de recherche de disponibilité -->
                        <form action="{{route('search-room')}}" method="post">
                            @csrf
                            @if(isset($availableRooms))
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="card-label">Check In:</label>
                                    <input type="date" id="checkin" required value="{{$checkin}}" class="checkinclass form-control" name="checkin">
                                </div>
                                <div class="col-md-4">
                                    <label class="card-label">Check out:</label>
                                    <input type="date" id="checkout" value="{{$checkout}}" required class="checkoutclass form-control" name="checkout">
                                </div>
                                <div class="col-md-4">
                                    <label class="card-label">Check Availability by date</label>
                                    <button type="submit" class="btn btn-primary w-100">Check Now</button>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="card-label">Check In:</label>
                                    <input type="date" id="checkin" required value="{{$today}}" class="checkinclass form-control" name="checkin">
                                </div>
                                <div class="col-md-4">
                                    <label class="card-label">Check out:</label>
                                    <input type="date" id="checkout" value="{{$today}}" required class="checkoutclass form-control" name="checkout">
                                </div>
                                <div class="col-md-4">
                                    <label class="card-label">Check Availability by date</label>
                                    <button type="submit" class="btn btn-primary w-100">Check Now</button>
                                </div>
                            </div>
                            @endif
                        </form>
                        <!-- Fin du formulaire de recherche -->
                    </div>
                </div>
                <div class="underline mb-0"></div>
                <hr class="my-0">
            </div>

            <div class="col-md-12 mt-4">
                <div class="row">
                    @if(isset($availableRooms))
                    @if(count($availableRooms)>0)
                    @foreach($availableRooms as $room)
                    <div class="col-md-4">
                        <a href="{{route('views', ['id' => $room->id])}}" class="text-decoration-none">
                            <div class="card-box">
                                <div class="roomimage">
                                    <img src="uploads/{{$room->room_image}}" class="" alt="{{$room->room_name}}">
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

                    @else
                    @if(count($allRooms)>0)
                    @foreach($allRooms as $room)
                    <div class="col-md-4">
                        <a href="{{route('views', ['id' => $room->id])}}" class="text-decoration-none">
                            <div class="card-box">
                                <div class="roomimage">
                                    <img src="uploads/{{$room->room_image}}" class="" alt="{{$room->room_name}}">
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
                    @endif

                </div>
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