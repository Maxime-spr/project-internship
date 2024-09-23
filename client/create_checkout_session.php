<?php
session_start();
require_once '../vendor/autoload.php';

\Stripe\Stripe::setApiKey('clé secrete');

$YOUR_DOMAIN = 'http://localhost/project/client';

header('Content-Type: application/json');

$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'dzd',
            'product_data' => [
                'name' => 'Total Cart Amount',
            ],
            'unit_amount' => $_SESSION['totalAmount'] * 100, // En centimes
        ],
        'quantity' => 1,
    ]],
    'billing_address_collection' => 'required',
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/success.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

echo json_encode(['id' => $checkout_session->id]);
?>
