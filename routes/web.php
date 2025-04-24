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
Route::get('/event/create', [EventController::class,'create'])->name('events.create');
Route::get('/event/{uuid}/edit', [EventController::class,'edit'])->name('events.edit');
Route::post('/event', [EventController::class,'store'])->name('events.store');
Route::put('/event/{uuid}', [EventController::class,'update'])->name('events.update');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
