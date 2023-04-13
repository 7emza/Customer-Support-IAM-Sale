<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome')->with('info','You added new items, follow next step!');
    ;
});
Route::get('/prelogin/{type?}',function ($type=null)
{

    if (Auth::check()) {

        return redirect()->route("dashboard");
    }
    $pwd="password";

    return view('auth.login')->with("preuser","$type@estsale")->with("pwd","$pwd");
})->name('prelogin');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/addadmins', function () {
    return view('addadmins');
})->name('addadmins');

Route::get('/seed', function () {
    Artisan::call('db:seed');
    return 'Database seeded!';
});
