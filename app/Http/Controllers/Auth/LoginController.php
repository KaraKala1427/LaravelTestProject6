<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\MyUserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    protected $userRepository;


    public function __construct(MyUserRepository $repository)
    {
        $this->middleware('guest')->except('logout');
        $this->userRepository = $repository;
    }


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $this->_registerOrLoginUser($user);
        return redirect()->route('home');
    }

    protected function _registerOrLoginUser($data)
    {
        $user = $this->userRepository->getUserByEmail($data);
        if (!$user) {
            $user = $this->userRepository->create($data);
        }

        Auth::login($user);
    }
}
