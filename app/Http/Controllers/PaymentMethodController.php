<?php

namespace App\Http\Controllers;

use App\Components\Gateways\GatewayService;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Models\Customer;
use App\Models\PaymentMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class PaymentMethodController extends Controller
{
    /**
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/payment-method",
     *     tags={"Payment Method"},
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(PaymentMethod::all());
    }

    /**
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/payment-method",
     *     tags={"Payment Method"},
     *     @OA\Response(response="200", description="An example endpoint"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PaymentMethod")
     *     ),
     * )
     */
    public function store(StorePaymentMethodRequest $storePaymentMethodRequest, GatewayService $gatewayService): JsonResponse
    {
        /* @var Customer $customer */
        $customer = Customer::findOrFail($storePaymentMethodRequest['customer_id']);

        $paymentMethod = new PaymentMethod();
        $paymentMethod->setCustomer($customer);
        $paymentMethod->setName($storePaymentMethodRequest['name']);
        $paymentMethod->setExternalId('asd');
        $paymentMethod->save();

        $gatewayService->createCustomer($customer);

        return response()->json($paymentMethod);
    }

    /**
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/payment-method/{payment_method_id}",
     *     tags={"Payment Method"},
     *     @OA\Parameter(
     *         name="payment_method_id",
     *         in="path",
     *         description="ID of payment method to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function show(int $paymentMethodId): JsonResponse
    {
        return response()->json(PaymentMethod::with('customer')->findOrFail($paymentMethodId));
    }

    /**
     * @OA\Put(
     *     security={{"bearerAuth":{}}},
     *     path="/api/payment-method/{payment_method_id}",
     *     tags={"Payment Method"},
     *     @OA\Parameter(
     *         name="payment_method_id",
     *         in="path",
     *         description="ID of payment method to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function update(Request $request, PaymentMethod $paymentMethod): JsonResponse
    {
        return response()->json();
    }

    /**
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
     *     path="/api/payment-method/{payment_method_id}",
     *     tags={"Payment Method"},
     *     @OA\Parameter(
     *         name="payment_method_id",
     *         in="path",
     *         description="ID of payment method to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function destroy(PaymentMethod $paymentMethod): JsonResponse
    {
        $paymentMethod->delete();

        return response()->json(true);
    }
}
