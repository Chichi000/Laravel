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

Route::resource("/cust", "custController")->middleware("auth");
Route::get("/cust/restore/{id}", [
    "uses" => "custController@restore",
    "as" => "cust.restore",
]);
Route::get("/cust/forceDelete/{id}", [
    "uses" => "custController@forceDelete",
    "as" => "cust.forceDelete",
]);

Route::resource("/pets", "petController")->middleware("auth");
Route::get("/pets/restore/{id}", [
    "uses" => "petController@restore",
    "as" => "pets.restore",
]);
Route::get("/pets/forceDelete/{id}", [
    "uses" => "petController@forceDelete",
    "as" => "pets.forceDelete",
]);

Route::resource("/service", "serviceController")->middleware("auth");
Route::get("/service/restore/{id}", [
    "uses" => "serviceController@restore",
    "as" => "service.restore",
]);
Route::get("/service/forceDelete/{id}", [
    "uses" => "serviceController@forceDelete",
    "as" => "service.forceDelete",
]);

Route::resource("/employees", "employeesController")->middleware("auth");
Route::get("/employees/restore/{id}", [
    "uses" => "employeesController@restore",
    "as" => "employees.restore",
]);
Route::get("/employees/forceDelete/{id}", [
    "uses" => "employeesController@forceDelete",
    "as" => "employees.forceDelete",
]);

Route::get("signup", [
    "uses" => "employeesController@getSignup",
    "as" => "employees.signup",
]);

Route::post("signup", [
    "uses" => "employeesController@postSignup",
    "as" => "employees.signup",
]);

Route::get("admin", [
    "uses" => "employeesController@admin",
    "as" => "employees.admin",
])->middleware("auth");

Route::post("logout", [
    "uses" => "employeesController@getLogout",
    "as" => "employees.logout",
]);

Route::get("logout", [
    "uses" => "employeesController@getLogout",
    "as" => "employees.logout",
]);

Route::post("signin", [
    "uses" => "employeesController@postSignin",
    "as" => "employees.signin",
]);

Route::get("signin", [
    "uses" => "employeesController@getSignin",
    "as" => "employees.signin",
]);

Route::resource("/consultation", consultationController::class)->middleware(
    "auth"
);

Route::get("/consultation/restore/{id}", [
    "uses" => "consultationController@restore",
    "as" => "consultation.restore",
]);
Route::get("/consultation/forceDelete/{id}", [
    "uses" => "consultationController@forceDelete",
    "as" => "consultation.forceDelete",
]);

Route::resource("/kind", "kindController")->middleware("auth");
Route::get("/kind/restore/{id}", [
    "uses" => "kindController@restore",
    "as" => "kind.restore",
]);

Route::resource("/disInjury", "disInjuryController")->middleware("auth");
Route::get("/disInjury/restore/{id}", [
    "uses" => "disInjuryController@restore",
    "as" => "disInjury.restore",
]);

Route::get("/results", "App\Http\Controllers\consultationController@results")
    ->name("results")
    ->middleware("auth");

    Route::get("shopping-cart", [
        "uses" => 'App\Http\Controllers\transactionController@getCart',
        "as" => "transaction.shoppingCart",
        "middleware" => "auth",
    ]);

    Route::get("checkout", [
        "uses" => "transactionController@postCheckout",
        "as" => "checkout",
    ]);

    Route::get("/receipt", 'App\Http\Controllers\transactionController@getReceipt')
        ->name("receipt")
        ->middleware("auth");

    Route::get("info", [
        "uses" => 'App\Http\Controllers\transactionController@getInfo',
        "as" => "info",
        "middleware" => "auth",
    ]);

    Route::get("add-to-cart/{id}", [
        "uses" => 'App\Http\Controllers\transactionController@getAddToCart',
        "as" => "transaction.addToCart",
    ]);

    Route::get("add-pet/{id}", [
        "uses" => 'App\Http\Controllers\transactionController@getPet',
        "as" => "transaction.addPet",
    ]);

    Route::get("remove/{id}", [
        "uses" => 'App\Http\Controllers\transactionController@getRemoveItem',
        "as" => "transaction.remove",
    ]);
