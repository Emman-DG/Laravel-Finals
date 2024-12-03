<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;


Route::get('/', [RoomController::class, 'index'])->name('rooms.index');

Route::post('/', [RoomController::class, 'store'])->name('rooms.store');