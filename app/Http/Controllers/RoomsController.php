<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RoomsController extends Controller
{
    public function roomsDisplay()
    {
        $rooms = Room::all();
        $page = 'index';
        return view('index', compact('rooms', 'page'));
    }
    public function aboutUS()
    {
        $page = 'about';
        return view('about', compact('page'));
    }

    public function viewRoom($id)
    {
        $room = Room::find($id);
        $today = Carbon::now()->toDateString(); // Récupère la date d aujourd hui
        return view('views', compact('room', 'today'));
    }

    public function confirmBooking(Request $request)
    {
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        // Convertir les chaînes de date en objets Carbon
        $checkinDate = Carbon::createFromFormat('Y-m-d', $checkin);
        $checkoutDate = Carbon::createFromFormat('Y-m-d', $checkout);
        // Calculer la différence de jours
        $no_of_days = ($checkoutDate->diffInDays($checkinDate)) + 1;

        $room_id = $request->input('room_id');
        $room = Room::find($room_id);

        $total_price = $room->price * $no_of_days;
        $total_price_string = $room->price . " x " . $no_of_days . " days = " . $total_price;

        return view('confirm', compact('checkin', 'checkout', 'room', 'no_of_days', 'total_price', 'total_price_string'));
    }

    public function displayBooking()
    {
        $today = now()->format('Y-m-d');
        $id = Auth::user()->id;

        // Récupération des réservations à venir (upcoming bookings)
        $upcomingBookings = Booking::where('user_id', $id)
            ->where('checkin', '>=', $today)
            ->with('room')
            ->get();

        // Récupération des réservations plus anciennes (older bookings)
        $olderBookings = Booking::where('user_id', $id)
            ->where('checkout', '<', $today)
            ->get();

        return view('bookings', compact('upcomingBookings', 'olderBookings'));
    }

    public function effectiveReservation(Request $request)
    {
        if (!empty($request->fname) && !empty($request->lname) && !empty($request->phone) && !empty($request->email) && empty($request->gender)) {
            return redirect()->route('availability-room')->withErrors(['error' => 'Please retry the room reservation']);
        } else {
            // Récupérer les données soumises depuis le formulaire
            $bookroomid = $request->input('bookroomid');
            $checkin = $request->input('checkin');
            $checkout = $request->input('checkout');
            $totalprice = $request->input('totalprice');

            if ($request->fname && $request->lname && $request->phone && $request->email) {
                // Créer un nouvel utilisateur
                $user = User::create([
                    'id' => Str::uuid(),
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'password' => bcrypt('password'),
                    'status' => 0,
                ]);
                $recupId = User::where('email', $request->email)->pluck('id');
                $booking = Booking::create([
                    'id' => Str::uuid(),
                    'room_id' => $bookroomid,
                    'user_id' => $recupId[0],
                    'checkin' => $checkin,
                    'checkout' => $checkout,
                    'price' => $totalprice,
                    'payment_mode' => "Cash",
                    'booking_status' => 0,
                ]);
                if (Auth::attempt(['email' => $request->email, 'password' => 'password'])) {
                    return redirect()->route('bookings')->with('success', 'Your room has been successfully booked');
                } else {
                    return redirect()->route('home')->with('success', 'User account and room reservation made successfully');
                }
            } else {
                $booking = Booking::create([
                    'id' => Str::uuid(),
                    'room_id' => $bookroomid,
                    'user_id' => Auth::user()->id,
                    'checkin' => $checkin,
                    'checkout' => $checkout,
                    'price' => $totalprice,
                    'payment_mode' => "Cash",
                    'booking_status' => 0,
                ]);
                return redirect()->route('bookings')->with('success', 'Your room has been successfully booked');
            }
        }
    }

    public function findAvailableRooms(Request $request)
    {

        if ($request->input('checkin') && $request->input('checkout')) {
            $checkin = $request->input('checkin');
            $checkout = $request->input('checkout');
            $availableRooms = Room::whereNotIn('id', function ($query) use ($checkin, $checkout) {
                $query->select('room_id')
                    ->from('bookings')
                    ->where(function ($q) use ($checkin, $checkout) {
                        $q->where('checkin', '<=', $checkin)
                            ->where('checkout', '>=', $checkout);
                    })
                    ->orWhere(function ($q) use ($checkin, $checkout) {
                        $q->whereBetween('checkin', [$checkin, $checkout])
                            ->orWhereBetween('checkout', [$checkin, $checkout]);
                    })
                    ->orWhere(function ($q) use ($checkin, $checkout) {
                        $q->where('checkin', '<=', $checkin)
                            ->where('checkout', '>=', $checkin);
                    });
            })->get();
            $page = 'all-room';
            return view('all-rooms', compact('availableRooms', 'checkin', 'checkout', 'page'));
        } else {
            $today = now()->format('Y-m-d');
            $allRooms = Room::where('status', '0')->get();
            $page = "all-room";
            return view('all-rooms', compact('today', 'allRooms', 'page'));
        }
    }

    public function deleteBooking($reservationId)
    {
        $reservation = Booking::find($reservationId);
        if ($reservation) {
            $reservation->delete();
            return redirect()->back()->with('success', 'The reservation was successfully canceled.');
        } else {
            return redirect()->back()->with('error', 'The reservation cannot be found.');
        }
    }
}
