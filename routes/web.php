<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\custController;
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

Route::resource("/cust", "custController");
Route::get("/cust/restore/{id}", [
    "uses" => "custController@restore",
    "as" => "cust.restore",
]);
Route::get("/cust/forceDelete/{id}", [
    "uses" => "custController@forceDelete",
    "as" => "cust.forceDelete",
]);

Route::resource("/pets", "petController");
Route::get("/pets/restore/{id}", [
    "uses" => "petController@restore",
    "as" => "pets.restore",
]);
Route::get("/pets/forceDelete/{id}", [
    "uses" => "petController@forceDelete",
    "as" => "pets.forceDelete",
]);
