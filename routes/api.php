<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')
    ->group(
        function () {
            Route::get(
                '/user', function (Request $request) {
                        return $request->user();
                }
            );
            //Logout
            Route::post('/logout', 'AuthController@logout');

            // Get User Notes
            Route::get('user/notes', 'NoteController@showUserNotes');

            // Create note
            Route::post('note', 'NoteController@store');

            // Update note
            Route::put('note', 'NoteController@update');

            // Delete note
            Route::delete('note/{id}', 'NoteController@destroy');

        }
    );



//Login
Route::post('login', 'AuthController@login');

//Register
Route::post('register', 'AuthController@register');

// All notes
Route::get('notes', 'NoteController@index');

// Single note
Route::get('note/{id}', 'NoteController@show');