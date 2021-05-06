<?php

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

Route::get('/', "MainController@MainPage")->name("main");
Route::get('/user', "UserWorkController@MainPage")->name("user");
Route::post('/addmsg', "UserWorkController@AddMsg")->name("addmsg");

Route::get('/manager', "ManagerWorkController@MainPage")->name("manager");
Route::post('/readed', "ManagerWorkController@Readed")->name("readed");

Route::post('/login', "AuthController@login")->name("login");
Route::post('/reg', "AuthController@Reg")->name("reg");


Route::get('/logout', "AuthController@LogOut")->name("logout");
