<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['customer' => 'index']);
    }

    public function store(StoreCustomerRequest $storeCustomerRequest): JsonResponse
    {
        $customer = new Customer();
        $customer->setEmail($storeCustomerRequest['email']);
        $customer->setFirstName($storeCustomerRequest['first_name']);
        $customer->setLastName($storeCustomerRequest['last_name']);
        $customer->save();

        return response()->json($customer);
    }

    public function show($customer_id): JsonResponse
    {
        return response()->json(Customer::findOrFail($customer_id));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): JsonResponse
    {
        return response()->json();
    }

    public function destroy(Customer $customer): JsonResponse
    {
        $customer->delete();

        return response()->json(true);
    }
}
