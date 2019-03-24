<?php

namespace App\Http\Controllers;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Wrong E-mail or Password'], 401);
        }
        $this->updateUser($token);
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->updateUser(null, true);
        auth()->logout();


        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $this->updateUser($token);
        return $this->me();
    }
    protected function updateUser($token, $logout = false)
    {
        if($logout){
            auth()->user()->jwt_token = null;
            auth()->user()->jwt_token_expired_date = null;
        }else{
            auth()->user()->jwt_token = $token;
            auth()->user()->jwt_token_expired_date = date("Y-m-d H:i:s", now()->timestamp + auth()->factory()->getTTL() * env("JWT_TTL", 60));
        }
        auth()->user()->save();

    }
}
