<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

// DB::listen(function ($event) {
//     dump($event->sql);
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/events', [EventController::class,'index'])->name('events.index');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
