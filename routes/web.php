<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\UserController;
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
});

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');

Route::get('/animals', function () {
    return view('animals');
})->middleware('auth')->name('animals');

Route::get('/houses', function () {
    return view('houses');
})->middleware('auth')->name('houses');
Route::post('/profile/updateImage', [UserController::class, 'updateImage'])->name('profile.updateImage');
Route::post('/profile/update-info/{id}', [UserController::class, 'updateInfo'])->name('profile.updateInfo');
Route::get('/animals', [AnimalController::class, 'index'])->name('animals');
Route::get('/animals/create', [AnimalController::class, 'create'])->name('animals.create');
Route::post('/animals', [AnimalController::class, 'store'])->name('animals.store');
Route::delete('animals/{animal}', [AnimalController::class, 'destroy'])->name('animals.destroy');
Route::get('animals/{animal}/edit', [AnimalController::class, 'edit'])->name('animals.edit');
Route::put('animals/{animal}', [AnimalController::class, 'update'])->name('animals.update');
Route::get('/houses', [HouseController::class, 'index'])->name('houses');
Route::get('/houses/create', [HouseController::class, 'create'])->name('houses.create');
Route::post('/houses', [HouseController::class, 'store'])->name('houses.store');
Route::delete('houses/{house}', [HouseController::class, 'destroy'])->name('houses.destroy');
Route::get('houses/{house}/edit', [HouseController::class, 'edit'])->name('houses.edit');
Route::put('houses/{house}', [HouseController::class, 'update'])->name('houses.update');
