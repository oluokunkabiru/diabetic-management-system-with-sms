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
Route::get('mark-as-read/{id}', 'UserController@readNotification')->name('mark-as-read');
Route::get('mark-all-as-read', 'UserController@readAllNotification')->name('mark-all-as-read');

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth', 'staff'])->prefix('staff')->group(function () {

Route::get('dashboard', 'StaffController@index')->name('staffdashboard');
Route::resource('permission', 'PermissionController');
Route::post('remove-permission', 'PermissionController@removepermission')->name('remove-permission');

    Route::resource('settings', 'SettingController');
    Route::resource('user-management', 'UsersController');
    Route::resource('settings', 'SettingController');
    Route::get('/disabled/{id}/users', 'UsersController@disables')->name('disabled-user');
    Route::get('/enabled/{id}/users', 'UsersController@enable')->name('enable-user');
    Route::put('/addrole/{id}/users', 'UsersController@addrole')->name('addrole-user');
    Route::resource('role', 'RoleController');
    Route::resource('question-category', 'CategoryController');
    Route::resource('question-bank', 'QuestionController');



});

Route::middleware(['auth', 'patient'])->prefix('patient')->group(function () {

    Route::get('dashboard', 'PatientController@index')->name('patientdashboard');

    });
