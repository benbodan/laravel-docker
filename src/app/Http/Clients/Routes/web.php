<?php

use Illuminate\Support\Facades\Route;
// With "clients" Prefix From RouteServiceProvider

Route::get('/', 'ClientsController@index');
