<?php

use App\Http\Controllers\connectionManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomsController;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [RoomsController::class, 'roomsDisplay']);

Route::get('/Home', [RoomsController::class, 'roomsDisplay'])->name('home');

Route::get('/About Us', [RoomsController::class, 'aboutUS'])->name('about');

Route::get('Availability Rooms', [RoomsController::class, 'findAvailableRooms'])->name('availability-room');

Route::post('Search for room availability', [RoomsController::class, 'findAvailableRooms'])->name('search-room');

Route::get('Login', [connectionManagementController::class, 'loginForm'])->name('login');

Route::get('Register', [connectionManagementController::class, 'registerForm'])->name('register');


Route::get('Details-{id}', [RoomsController::class, 'viewRoom'])->name('views');


Route::post('Effective Reservation', [RoomsController::class, 'effectiveReservation'])->name('effectiveReservation');

Route::post('Confirmation', [RoomsController::class, 'confirmBooking'])->name('confirm');

Route::post('User Register', [connectionManagementController::class, 'registerUser'])->name('registering');

Route::post('Current connection', [connectionManagementController::class, 'loginUser'])->name('connection');

Route::get('Logout', [connectionManagementController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'authHotel'], function () {
    // Les routes qui nécessitent une authentification ici
    Route::get('Bookings', [RoomsController::class, 'displayBooking'])->name('bookings');

    Route::get('Cancel reservation-{reservationId}', [RoomsController::class, 'deleteBooking'])->name('deleteBooking');

    Route::post('Updated profile', [ProfileController::class, 'updatedProfile'])->name('updateProfile');

    Route::get('Profile', [ProfileController::class, 'displayProfile'])->name('profile');
});
