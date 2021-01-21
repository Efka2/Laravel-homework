<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
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
    return view('startingPage');
})->name('startingPage');

Route::get('/welcome', function () {
    $users = User::all();
    return view('welcome')->with('users', $users);
})->middleware(['auth'])->name('welcome');


require __DIR__ . '/auth.php';
