<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function me(): JsonResponse
    {
        $user = User::where('email', auth()->user()->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        }

        return response()->json(new UserResource($user), 200);
    }

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        return response()->json([
            'token' => $token,
        ], 200);
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;

                $cookie = $this->getCookieDetails($token);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Login realizado com sucesso',
                    'user' => new UserResource($user),
                ], 200)
                ->withCookie(
                    $cookie['name'],
                    $cookie['value'],
                    $cookie['minutes'],
                    $cookie['path'],
                    $cookie['domain'],
                    $cookie['secure']
                );
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Credenciais informadas estão inválidas',
        ], 401);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        $cookie = Cookie::forget('_token');

        return response()->json([
            'message' => 'Logout realizado com sucesso',
        ], 200)->withCookie($cookie);
    }

    private function getCookieDetails(string $token): array
    {
        return [
            'name' => '_token',
            'value' => $token,
            'minutes' => 1440,
            'path' => null,
            'domain' => null,
            // 'secure' => true, // for production
            'secure' => null, // for localhost
            'httponly' => false,
            'samesite' => false,
        ];
    }
}
