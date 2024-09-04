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
                <h4 class="main-heading">My Bookings</h4>
                <div class="underline mb-0"></div>
                <hr class="my-0">
            </div>
        </div>

        <div class="row justify-content-center">
            @if(!empty($upcomingBookings) || !empty($olderBookings))
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="fw-bold text-dark mb-0">Upcoming Bookings</h4>
                    </div>
                    <div class="card-body">
                        <table class="myTable table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Room Name</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Price</th>
                                    <th>Booked on</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($upcomingBookings as $upcomingBooking)
                                <tr>
                                    <td>{{$upcomingBooking->room->room_name}}</td>
                                    <td>{{$upcomingBooking->checkin}}</td>
                                    <td>{{$upcomingBooking->checkout}}</td>
                                    <td>{{$upcomingBooking->price}}</td>
                                    <td>{{$upcomingBooking->created_at}}</td>
                                    <td>
                                        <a href="#" class="btn btn-danger cancel-btn" data-reservation-id="{{$upcomingBooking->id}}">Cancel</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="fw-bold text-white mb-0">Older Bookings</h4>
                    </div>
                    <div class="card-body">
                        <table class="myTable table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Room Name</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Price</th>
                                    <th>Booked on</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($olderBookings as $olderBooking)
                                <tr>
                                    <td>{{$olderBooking->room->room_name}}</td>
                                    <td>{{$olderBooking->checkin}}</td>
                                    <td>{{$olderBooking->checkout}}</td>
                                    <td>{{$olderBooking->price}}</td>
                                    <td>{{$olderBooking->created_at}}</td>
                                    <td><a href="#" class="btn btn-danger cancel-btn" data-reservation-id="{{$olderBooking->id}}">Cancel</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-6 text-center">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="heading">You have not Made Any Bookings</h2>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>


@endsection

@section('footer-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(".cancel-btn").on("click", function(e) {
        e.preventDefault();

        const reservationId = $(this).data("reservation-id");

        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Voulez-vous annuler cette réservation ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, annuler !'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/Cancel reservation-" + reservationId;
            } else {

            }
        });
    });
</script>

@endsection