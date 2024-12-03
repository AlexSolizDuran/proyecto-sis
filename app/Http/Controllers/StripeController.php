<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Http\Controllers\Admin\Venta\CarritoController;
use App\Models\NotaVenta;

class StripeController extends Controller
{

    // Método para mostrar el formulario de pago
    public function showPaymentForm()
    {
        $stripeKey = env('STRIPE_KEY');
        return view('cliente.zapato.carro', compact('stripeKey'));
    }


    public function processPayment(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
       
        try {
            $carritoController = new CarritoController();
            $carritoController->store($request);
            $montoTotal = session()->get('montoTotal');
            $montoTotal = $montoTotal * 0.15;
            // Realiza el cargo en Stripe
            Charge::create([
                'amount' => $montoTotal * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Pago realizado con Stripe',
            ]);

            // Envía a la vista la confirmación del éxito del pago
            // Redirige con el mensaje de éxito
            session()->forget('carro');
            session()->forget('montoTotal');
            return redirect()->route('zapato.pedido')->with('success', 'Pago realizado con éxito');

        } catch (\Exception $e) {
            // Redirige con el mensaje de error
            $notaventa = NotaVenta::orderBy('nro', 'desc')->first();
            $notaventa->delete();
            return redirect()->route('zapato.pedido')->with(['success' => 'Hubo un error en el pago']);
        }
    }
}