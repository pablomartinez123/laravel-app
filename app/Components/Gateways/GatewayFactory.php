<?php

namespace App\Components\Gateways;

use App\Models\Gateway;
use LogicException;

class GatewayFactory
{
    private StripeService $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function createGateway(string $code): GatewayInterface
    {
        switch ($code) {
            case Gateway::STRIPE:
                $gateway = $this->stripeService;
                break;
            default:
                throw new LogicException();
        }

        return $gateway;
    }
}
