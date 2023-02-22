<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\User as UserResource;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Validator;

class AuthController extends BaseController
{
    /**
     * Register API
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'device_name' => 'string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole('racer');

        $token = $request->device_name ?? 'pdrnl-token';
        $success['token'] = $user->createToken($token)->plainTextToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User register successfully.', 200);
    }

    /**
     * Login API
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $request->device_name ?? 'pdrnl-token';
            $success['token'] = $user->createToken($token)->plainTextToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, 'User login successfully.', 200);
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Logout API
     */
    public function logout(Request $request): JsonResponse
    {
        $user = User::where('email', $request->user()->email)->first();

        if ($user) {
            // use this to revoke all tokens (logout from all devices)
            $user->tokens()->delete();
            // Revoke the token that was used to authenticate the current request
            // $user()->currentAccessToken()->delete();
            return $this->sendResponse([], 'User logged out successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Get authenticated user info
     */
    public function authenticatedUser(Request $request): JsonResponse
    {
        return $this->sendResponse(new UserResource(Auth::user()), 'User info retrieved successfully.');
    }
}
