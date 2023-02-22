<?php

namespace App\Components\Gateways;

use App\Models\Customer;
use App\Models\Gateway;

class GatewayService
{
    private GatewayFactory $gatewayFactory;

    public function __construct(GatewayFactory $gatewayFactory)
    {
        $this->gatewayFactory = $gatewayFactory;
    }

    public function createCustomer(Customer $customer): array
    {
        $code = Gateway::STRIPE;
        $gatewayInterface = $this->gatewayFactory->createGateway($code);

        return $gatewayInterface->createCustomer($customer);
    }
}
