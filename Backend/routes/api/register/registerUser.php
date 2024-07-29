<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Register')->group(function () {
    Route::post('register-user', 'RegisterUserController@registerUser');
});