<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountGatewayRequest;
use App\Http\Requests\UpdateAccountGatewayRequest;
use App\Models\Account;
use App\Models\AccountGateway;
use App\Models\Gateway;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class AccountGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
    }

    /**
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/account-gateway",
     *     tags={"Account gateway"},
     *     @OA\Response(response="200", description="An example endpoint"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AccountGateway")
     *     ),
     * )
     */
    public function store(StoreAccountGatewayRequest $storeAccountGatewayRequest): JsonResponse
    {
        /* @var Account $account */
        $account = Account::findOrFail($storeAccountGatewayRequest['account_id']);

        /* @var Gateway $gateway */
        $gateway = Gateway::findOrFail($storeAccountGatewayRequest['gateway_id']);

        $accountGateway = new AccountGateway();
        $accountGateway->setAccount($account);
        $accountGateway->setGateway($gateway);
        $accountGateway->setName($storeAccountGatewayRequest['name']);
        $accountGateway->save();

        return response()->json($accountGateway);
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountGateway $accountGateway): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountGatewayRequest $request, AccountGateway $accountGateway): JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountGateway $accountGateway): JsonResponse
    {
        //
    }
}
