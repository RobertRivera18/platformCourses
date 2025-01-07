<?php

namespace App\Http\Controllers;

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
        $client_id = config('services.paypal.client_id');
        $secret_key = config('services.paypal.secret_id');
        $auth = base64_encode($client_id . ':' . $secret_key);
        return $auth;
        $url = config('services.paypal.url');
        $response = Http::withHeaders([
            'Authorization' => 'Basic' . $auth,

        ])
        ->asForm()
            ->post($url, [
                'grant_type' => 'client_credentials'
            ])->json();
    }
}
