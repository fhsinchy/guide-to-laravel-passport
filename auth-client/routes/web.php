<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

Route::view('/', 'home');

Route::get('/redirect', function (Request $request) {
    $query = http_build_query([
        'client_id' => env('OAUTH_CLIENT_ID'),
        'redirect_uri' => env('OAUTH_CLIENT_REDIRECT'),
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect(env('OAUTH_AUTH_SERVER') . '/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {
    $response = Http::asForm()->post(env('OAUTH_AUTH_SERVER') . '/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => env('OAUTH_CLIENT_ID'),
        'client_secret' => env('OAUTH_CLIENT_SECRET'),
        'redirect_uri' => env('OAUTH_CLIENT_REDIRECT'),
        'code' => $request->code,
    ]);

    return $response->json();
});
