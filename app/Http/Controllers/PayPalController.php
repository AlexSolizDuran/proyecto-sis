<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class PayPalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('services.paypal.client_id'),     // Client ID
                config('services.paypal.secret')         // Client Secret
            )
        );

        $this->apiContext->setConfig(config('services.paypal.settings'));
    }

    public function payWithPayPal()
    {
        $montoTotal = session()->get('montoTotal');
        // BOB -> USD
        $montoTotal = $montoTotal * 0.15;
        // Configuración del pagador
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        
        // Configuración de la cantidad total
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($montoTotal); // Total en dólares, asegurando que sea un número (float o int)

        // Configuración de la transacción
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription('Pago con PayPal');

        // URLs de redirección
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('inicio'))
            ->setCancelUrl(route('inicio')); // URL de cancelación de PayPal

        // Creación del pago
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]); // Asegúrate de pasar un array de transacciones

            session()->forget('montoTotal');
        try {
            $payment->create($this->apiContext);
            
            return Redirect::away($payment->getApprovalLink());
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }
}