<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CodersFree\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }
    public function pay()
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.client_id'),     // ClientID
                config('services.paypal.secret_id'),     // ClientSecret
            )
        );
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $subtotal = Cart::subTotal();

        // Asegúrate de que sea numérico y formateado correctamente
        $subtotal = number_format((float) $subtotal, 2, '.', ''); 
        
        
        $amount->setTotal($subtotal);  // Asegúrate de que sea un string con dos decimales
        $amount->setCurrency('USD');
    
        $amount->setCurrency('USD');
        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl("https://example.com/your_redirect_url.html")
            ->setCancelUrl("https://example.com/your_cancel_url.html");

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
            try {
                $payment->create($apiContext);
                return redirect()->away($payment->getApprovalLink());
                
            }
            catch (\PayPal\Exception\PayPalConnectionException $ex) {
                echo $ex->getData();
            }
    }
}
