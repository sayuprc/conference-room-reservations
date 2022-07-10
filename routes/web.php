<?php

declare(strict_types=1);

use App\Http\Controllers\Room\IndexRoomController;
use App\Http\Controllers\Room\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rooms', [IndexRoomController::class, 'handle'])->name('index');

Route::get('/rooms/register', [RegisterController::class, 'create']);
Route::post('/rooms/register', [RegisterController::class, 'handle']);
