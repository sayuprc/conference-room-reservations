<?php

declare(strict_types=1);

use App\Http\Controllers\Reservation\DeleteReservationController;
use App\Http\Controllers\Reservation\DetailReservationController;
use App\Http\Controllers\Reservation\RegisterReservationController;
use App\Http\Controllers\Reservation\UpdateReservationController;
use App\Http\Controllers\Room\DetailRoomController;
use App\Http\Controllers\Room\IndexRoomController;
use App\Http\Controllers\Room\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('index'));

Route::get('/rooms', [IndexRoomController::class, 'handle'])->name('index');

Route::get('/rooms/show/{id}', [DetailRoomController::class, 'handle'])->name('detail');

Route::get('/rooms/register', [RegisterController::class, 'create']);
Route::post('/rooms/register', [RegisterController::class, 'handle']);

Route::get('/reservations/register', [RegisterReservationController::class, 'create'])->name('reservations.register');
Route::post('/reservations/register', [RegisterReservationController::class, 'handle']);

Route::get('/reservations/show/{reservation_id}', [DetailReservationController::class, 'handle'])
    ->name('reservations.detail');

Route::post('/reservations/update', [UpdateReservationController::class, 'handle']);
Route::post('/reservations/delete', [DeleteReservationController::class, 'handle']);
