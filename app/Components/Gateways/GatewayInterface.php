<?php

namespace App\Components\Gateways;

use App\Models\Customer;

interface GatewayInterface
{
    public function createCustomer(Customer $customer): array;
}
