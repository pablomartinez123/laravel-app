<?php

namespace App\Components\Gateways;

use Stripe\StripeClient;

class StripeConnector
{
    public function createCustomer(string $email, string $name): array
    {
        $secretKey = 'sk_test_51MePfoDs5gNWnf0Y7aIFoOi3fOhCJReEi79cEtQQPnJUNUe5iP2J2LxUejYvqAXybcNFksNeOWzbEjnIdrNXkMQp00kt107yYA';
        $stripe = new StripeClient($secretKey);

        $customer = $stripe->customers->create([
            'description' => $name,
            'email' => $email,
            'payment_method' => 'pm_card_visa',
        ]);

        return $customer->toArray();
    }
}
