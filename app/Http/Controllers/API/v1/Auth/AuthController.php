<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    /**
     * @method POST
     * @param Request $request
     *
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required']
        ]);
        $user = resolve(UserRepository::class)->create($request);
        $defaultSuperAdminEmail = config('permission.default_super_admin_email');
        $user->email == $defaultSuperAdminEmail ? $user->assignRole('Super Admin') : $user->assignRole('User');
        return response()->json([
            'message' => 'user created success',
        ], Response::HTTP_CREATED);
    }

    /**
     * @method GET
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(Auth::user(), Response::HTTP_OK);
        }
        throw ValidationException::withMessages([
            'email' => 'incorrect credentials.'
        ]);
    }

    public function user()
    {
        return response()->json(Auth::user(), Response::HTTP_OK);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'logout success'
        ], Response::HTTP_OK);
    }

}
