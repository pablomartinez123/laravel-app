<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class AccountController extends Controller
{
    /**
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/account",
     *     tags={"Account"},
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(Account::all());
    }

    /**
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/account",
     *     tags={"Account"},
     *     @OA\Response(response="200", description="An example endpoint"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Account")
     *     ),
     * )
     */
    public function store(StoreAccountRequest $storeAccountRequest): JsonResponse
    {
        $account = new Account();
        $account->setName($storeAccountRequest['name']);
        $account->save();

        return response()->json($account);
    }

    /**
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/account/{account_id}",
     *     tags={"Account"},
     *     @OA\Parameter(
     *         name="account_id",
     *         in="path",
     *         description="ID of account to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function show(int $account_id): JsonResponse
    {
        return response()->json(Account::findOrFail($account_id));
    }

    /**
     * @OA\Put(
     *     security={{"bearerAuth":{}}},
     *     path="/api/account/{account_id}",
     *     tags={"Account"},
     *     @OA\Parameter(
     *         name="account_id",
     *         in="path",
     *         description="ID of account to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function update(UpdateAccountRequest $request, Account $account): JsonResponse
    {
        return response()->json();
    }

    /**
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
     *     path="/api/account/{account_id}",
     *     tags={"Account"},
     *     @OA\Parameter(
     *         name="account_id",
     *         in="path",
     *         description="ID of account to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function destroy(Account $account): JsonResponse
    {
        $account->delete();

        return response()->json(true);
    }
}
