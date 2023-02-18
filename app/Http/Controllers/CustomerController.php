<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CustomerController extends Controller
{
    /**
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/customer",
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(Customer::all());
    }

    /**
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/customer",
     *     @OA\Response(response="200", description="An example endpoint"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Customer")
     *     ),
     * )
     */
    public function store(StoreCustomerRequest $storeCustomerRequest): JsonResponse
    {
        $customer = Customer::where('email', $storeCustomerRequest['email'])->get();
        if (count($customer) > 0) {
            throw new BadRequestException('Email already exist!');
        }

        $customer = new Customer();
        $customer->setEmail($storeCustomerRequest['email']);
        $customer->setFirstName($storeCustomerRequest['first_name']);
        $customer->setLastName($storeCustomerRequest['last_name']);
        $customer->save();

        return response()->json($customer);
    }

    /**
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
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
     *     security={{"bearerAuth":{}}},
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
    public function update(UpdateCustomerRequest $updateCustomerRequest, Customer $customer): JsonResponse
    {
        $customer = Customer::find($customer->id);

        if ($updateCustomerRequest->get('email')) {
            $customer->setEmail($updateCustomerRequest->get('email'));
        }
        if ($updateCustomerRequest->get('first_name')) {
            $customer->setFirstName($updateCustomerRequest->get('first_name'));
        }
        if ($updateCustomerRequest->get('last_name')) {
            $customer->setLastName($updateCustomerRequest->get('last_name'));
        }
        $customer->save();

        return response()->json($customer);
    }

    /**
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
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
