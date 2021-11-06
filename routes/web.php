<?php

use App\Http\Controllers\TypeController;
use App\Http\Controllers\EntraineurController;
use App\Http\Controllers\AdherentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CoachController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('types','TypeController'); //->middleware('auth');
Route::get('types/{id}/edit/', [TypeController::class, 'edit']); //->middleware('auth');

Route::resource('entraineurs','EntraineurController')->middleware('auth');
Route::get('entraineurs/{id}/edit/', [EntraineurController::class, 'edit'])->middleware('auth');


Route::resource('adherents','AdherentController')->middleware('auth');
Route::get('adherents/{id}/edit/', [AdherentController::class, 'edit'])->middleware('auth');

Route::resource('products','ProductController')->middleware('auth');
Route::get('products/{id}/edit/', [ProductController::class, 'edit'])->middleware('auth');

//Route::resource('coachs','CoachController');
//Route::get('coachs/{id}/edit/', [CoachController::class, 'edit']);

