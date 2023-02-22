<?php

namespace App\Components\Gateways;

use App\Models\Customer;

class StripeService implements GatewayInterface
{
    private StripeConnector $stripeConnector;

    public function __construct(StripeConnector $stripeConnector)
    {
        $this->stripeConnector = $stripeConnector;
    }

    public function createCustomer(Customer $customer): array
    {
        return $this->stripeConnector->createCustomer($customer->getEmail(), $customer->getFirstName() . ' ' . $customer->getLastName());
    }
}
