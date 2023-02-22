<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use OpenApi\Annotations as OA;

class TokenController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/tokens",
     *     tags={"Tokens"},
     *     @OA\Response(response="200", description="An example endpoint"),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *              required={"email","password", "device_name"},
     *              @OA\Property(property="email", format="string"),
     *              @OA\Property(property="password", format="string"),
     *              @OA\Property(property="device_name", format="string"),
     *          ),
     *     ),
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token  = $user->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token]);
    }

    /**
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
     *     path="/api/tokens",
     *     tags={"Tokens"},
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(true);
    }
}
