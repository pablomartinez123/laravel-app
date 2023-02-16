<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class CustomerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/customer",
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(['customer' => 'index']);
    }

    /**
     * @OA\Post(
     *     path="/api/customer",
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function store(StoreCustomerRequest $storeCustomerRequest): JsonResponse
    {
        $customer = new Customer();
        $customer->setEmail($storeCustomerRequest['email']);
        $customer->setFirstName($storeCustomerRequest['first_name']);
        $customer->setLastName($storeCustomerRequest['last_name']);
        $customer->save();

        return response()->json($customer);
    }

    /**
     * @OA\Get(
     *     path="/api/customer/{customer_id}",
     *     @OA\Parameter(
     *         name="customer_id",
     *         in="path",
     *         description="ID of customer to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function show($customer_id): JsonResponse
    {
        return response()->json(Customer::findOrFail($customer_id));
    }

    /**
     * @OA\Put(
     *     path="/api/customer/{customer_id}",
     *     @OA\Parameter(
     *         name="customer_id",
     *         in="path",
     *         description="ID of customer to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): JsonResponse
    {
        return response()->json();
    }

    /**
     * @OA\Delete(
     *     path="/api/customer/{customer_id}",
     *     @OA\Parameter(
     *         name="customer_id",
     *         in="path",
     *         description="ID of customer to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function destroy(Customer $customer): JsonResponse
    {
        $customer->delete();

        return response()->json(true);
    }
}
