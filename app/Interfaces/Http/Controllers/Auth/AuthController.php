<?php

namespace App\Interfaces\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\User\Entities\User;

class AuthController extends BaseController
{
    use AuthenticatesUsers;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>
            [
                'login',
                'register'
            ]
        ]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = $this->validateCredentials($request);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],400);
        }

        if ($this->hasTooManyLoginAttempts($request)) {
            return response()->json(['error' => 'Você ultrapa o limite de tentativas.'], 429);
        }

        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            $this->clearLoginAttempts($request);
            return $this->respondWithToken($token);
        }
        return $this->failedLogin($request);
    }

    /**
     * Validate provided credentials (email)
     *
     * @param Request $request
     * @return array
     */
    protected function validateCredentials(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = $this->validateRegister($request);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            $this->clearLoginAttempts($request);
            return $this->respondWithToken($token);
        }
        return $this->failedLogin($request);
    }

    /**
     * Validate register new user
     *
     * @param Request $request
     * @return array
     */
    protected function validateRegister(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:3',
            'password_confirmation' => 'required|min:3' 
        ]);
    }

    /**
     * The login failed
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function failedLogin(Request $request)
    {
        $this->incrementLoginAttempts($request);
        return response()->json(['error' => 'Essas credenciais não correspondem aos nossos registros.'], 400);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Logout com sucesso.']);
    }

    /**
     * Refresh a token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure
     *
     * @param  string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
