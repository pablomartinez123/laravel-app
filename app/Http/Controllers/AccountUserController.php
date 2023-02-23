<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountUserRequest;
use App\Http\Requests\UpdateAccountUserRequest;
use App\Models\Account;
use App\Models\AccountUser;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class AccountUserController extends Controller
{
    /**
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/account-user",
     *     tags={"Account User"},
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(AccountUser::with(['account', 'user'])->get());
    }

    /**
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/account-user",
     *     tags={"Account User"},
     *     @OA\Response(response="200", description="An example endpoint"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AccountUser")
     *     ),
     * )
     */
    public function store(StoreAccountUserRequest $storeAccountUserRequest): JsonResponse
    {
        /* @var Account $account */
        $account = Account::findOrFail($storeAccountUserRequest['account_id']);

        /* @var User $user */
        $user = User::findOrFail($storeAccountUserRequest['user_id']);

        $accountUser = new AccountUser();
        $accountUser->setAccount($account);
        $accountUser->setUser($user);
        $accountUser->save();

        return response()->json($accountUser);
    }

    /**
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/account-user/{account_user_id}",
     *     tags={"Account User"},
     *     @OA\Parameter(
     *         name="account_user_id",
     *         in="path",
     *         description="ID of account user to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function show(int $account_user): JsonResponse
    {
        return response()->json(AccountUser::with(['account', 'user'])->findOrFail($account_user));
    }

    /**
     * @OA\Put(
     *     security={{"bearerAuth":{}}},
     *     path="/api/account-user/{account_user_id}",
     *     tags={"Account User"},
     *     @OA\Parameter(
     *         name="account_user_id",
     *         in="path",
     *         description="ID of account user to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function update(UpdateAccountUserRequest $request, AccountUser $accountUser): JsonResponse
    {
        return response()->json();
    }

    /**
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
     *     path="/api/account-user/{account_user_id}",
     *     tags={"Account User"},
     *     @OA\Parameter(
     *         name="account_user_id",
     *         in="path",
     *         description="ID of account user to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function destroy(AccountUser $accountUser): JsonResponse
    {
        $accountUser->delete();

        return response()->json(true);
    }
}
