<?php

use App\Mail\EmailAuth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

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
    // return view('welcome');
    return view('/auth.login');
});

Auth::routes(['verify' => true]);

/**
 * Edit Profile Route
 */ 
/*Route::resource('user', UserController::class)
    ->middleware('verified')
    ->only(['edit', 'update']);*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

/**
 * Mensagem Resource
 */
Route::resource('mensagens', App\Http\Controllers\MensagemController::class)->middleware('auth')->middleware('verified');

/* Add message route to update position */
Route::post('mensagens/updatepos', [App\Http\Controllers\MensagemController::class, 'updatePosition'])->middleware('auth')->middleware('verified');


/**
 * Email Auth
 */
Route::get('/email', function () {
    return new EmailAuth();
});