<?php

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

Route::get("/", "TodoController@get")->name("view");

Auth::routes();

Route::get("/home", "HomeController@index")->name("home");

Route::get("/create", "TodoController@create")->name("create");
Route::post("/create", "TodoController@add")->name("create");

Route::post("/done", "TodoController@done");
Route::delete("/delete", "TodoController@delete");
