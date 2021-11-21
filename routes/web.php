<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth', 'staff'])->prefix('staff')->group(function () {

Route::get('dashboard', 'StaffController@index')->name('staffdashboard');

});

Route::middleware(['auth', 'patient'])->prefix('patient')->group(function () {

    Route::get('dashboard', 'PatientController@index')->name('patientdashboard');

    });
