<?php

use App\Events\PlaygroundEvent;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

if(App::environment('local')) {
    Route::get('/play', function() {

        event(new PlaygroundEvent());

        // Mail::to('apidemo@test.com')->send(new WelcomeMail());

        // return 'Sent';

        //  return (new WelcomeMail())->render();
    });
}