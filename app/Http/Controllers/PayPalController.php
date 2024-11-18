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
        // Configuración del pagador
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Configuración del artículo
        $item = new Item();
        $item->setName('Producto de ejemplo')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice( 2.00); // Precio del producto en dólares

        // Lista de artículos
        $itemList = new ItemList();
        $itemList->setItems([$item]); // Asegúrate de pasar un array de items

        // Configuración de la cantidad total
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(2.00); // Total en dólares, asegurando que sea un número (float o int)

        // Configuración de la transacción
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Pago de ejemplo con PayPal');

        // URLs de redirección
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.success'))
            ->setCancelUrl(route('inicio')); // URL de cancelación de PayPal

        // Creación del pago
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]); // Asegúrate de pasar un array de transacciones

        try {
            $payment->create($this->apiContext);
            return Redirect::away($payment->getApprovalLink());
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }
}