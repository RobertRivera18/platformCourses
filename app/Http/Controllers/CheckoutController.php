<?php

namespace App\Http\Controllers;

use App\Models\Course;
use CodersFree\Shoppingcart\Facades\Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function createPaypalOrder()
    {
        $access_token = $this->generateAccessToken();
        $url = config('services.paypal.url') . "/v2/checkout/orders";
        Cart::instance('shopping');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $access_token,

        ])->post($url, [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => Cart::subtotal(),
                        'breakdown' => [
                            'item_total' => [
                                'currency_code' => 'USD',
                                'value' => Cart::subtotal(),
                            ],
                            'discount' => [
                                'currency_code' => 'USD',
                                'value' => 0,

                            ],
                        ],
                    ],
                    'items' => Cart::content()->map(function ($item) {
                        return [
                            'name' => $item->name,
                            'unit_amount' => [
                                'currency_code' => 'USD',
                                'value' => $item->price,
                            ],
                            'quantity' => $item->qty,
                            'sku' => $item->id
                        ];
                    })->values()->toArray(),


                ]

            ],

        ])->json();
        return $response;
    }



    public function capturePaypalOrder(Request $request)
    {
        
        $orderID = $request->orderID;
        $access_token = $this->generateAccessToken();
        $url = config('services.paypal.url') . "/v2/checkout/orders/{$orderID}/capture";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $access_token,

        ])->post($url, [
            'intent' => 'CAPTURE',
        ])->json();

        if (!isset($response["status"]) || $response["status"] !== 'COMPLETED') {
            throw new Exception('Error al capturar la orden de Paypal:' . json_decode($response));
        }

        //Matriculamos a los usuarios
        Cart::instance('shopping');
        foreach (Cart::content() as $item) {
            $course = Course::find($item->id);
            $course->students()->attach(auth()->id());
        }
        Cart::destroy();
        Cart::store(auth()->id());
       
    }




    public function generateAccessToken()
    {
        $client_id = config('services.paypal.client_id');
        $secret_key = config('services.paypal.secret_id');
        $auth = base64_encode($client_id . ':' . $secret_key);

        $url = config('services.paypal.url') . "/v1/oauth2/token";

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $auth,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->asForm()
            ->post($url, [
                'grant_type' => 'client_credentials'
            ])->json();

        if (!isset($response['access_token'])) {
            throw new \Exception('Error generating access token: ' . json_encode($response));
        }

        return $response['access_token'];
    }
}
