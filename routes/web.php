<?php

declare(strict_types=1);

use App\Http\Controllers\Room\IndexRoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rooms', [IndexRoomController::class, 'handle']);
