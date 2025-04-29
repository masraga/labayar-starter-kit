<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Koderpedia\Labayar\Payment;

class PaymentController extends Controller
{
  public function createTransaction(Request $request)
  {
    $orderId = "inv-" . time();
    $customer = [
      "name" => $request->customerName,
      "phone" => $request->customerPhone,
      "email" => $request->customerEmail,
    ];
    $amount = $request->payAmount;
    $items = [];
    for ($i = 0; $i < count($request->productId); $i++) {
      $items[] = [
        "productId" => $request->productId[$i],
        "price" => $request->productPrice[$i],
        "quantity" => $request->productQty[$i],
        "name" => $request->productName[$i],
      ];
    }
    $expiry = [
      "unit" => "minutes",
      "duration" => 60
    ];
    $payload = [
      "orderId" => $orderId,
      "customer" => $customer,
      "items" => $items,
      "expiry" => $expiry,
      "payAmount" => $amount
    ];
    $payment = new Payment();
    $tx = $payment->createInvoice($payload);
    return redirect("/api/labayar/orders");
  }

  public function loadSnapUI(Request $request)
  {
    $orderId = "inv-" . time();
    $customer = [
      "name" => $request->customerName,
      "phone" => $request->customerPhone,
      "email" => $request->customerEmail,
    ];
    $items = [];
    for ($i = 0; $i < count($request->productId); $i++) {
      $items[] = [
        "productId" => $request->productId[$i],
        "price" => $request->productPrice[$i],
        "quantity" => $request->productQty[$i],
        "name" => $request->productName[$i],
      ];
    }
    $expiry = [
      "unit" => "minutes",
      "duration" => 60
    ];
    $payload = [
      "orderId" => $orderId,
      "customer" => $customer,
      "items" => $items,
      "expiry" => $expiry,
    ];
    $payment = new Payment('tripay');
    return $payment->UISnapLabayar($payload);
  }
}
