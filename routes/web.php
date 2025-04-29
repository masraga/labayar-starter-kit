<?php

use App\Http\Controllers\PaymentController;
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
  $pgMode = true; //change this to true if you want to use payment gateway
  $pgUrl = "/snap";
  $manualUrl = "/createTransaction";
  $redirectUrl = $pgMode ? $pgUrl : $manualUrl;
  $products = [
    [
      "name" => "Jeruk sunkist bali",
      "productId" => "prd001",
      "price" => 10000,
      "image" => "/jeruk.webp"
    ],
    [
      "name" => "Apel fuji sumatera",
      "productId" => "prd002",
      "price" => 10000,
      "image" => "/apel.jpg"
    ],
    [
      "name" => "Jambu merah asli pekanbaru",
      "productId" => "prd002",
      "price" => 10000,
      "image" => "/jambu.webp"
    ],
  ];
  return view('welcome', compact("products", "redirectUrl", "pgMode"));
});

Route::post("/createTransaction", [PaymentController::class, "createTransaction"]);
Route::post("/snap", [PaymentController::class, "loadSnapUI"]);
