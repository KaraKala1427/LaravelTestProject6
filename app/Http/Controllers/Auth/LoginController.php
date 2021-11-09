<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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


    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleSignUp()
    {
        $redirectRegisterUri = config('services.google.redirect_register');
        return Socialite::driver('google')->redirectUrl($redirectRegisterUri)->redirect();
    }
    public function googleLoginHandler()
    {
        $user = Socialite::driver('google')->user();
        $resultBool = $this->loginUser($user);
        if($resultBool) return redirect()->route('home')->with('status','Вы успешно авторизованы');
        return redirect()->route('register')->with('status','Вы не зарегистрированы');
    }
    public function googleSignUpHandler()
    {
        $redirectRegisterUri = config('services.google.redirect_register');
        $user = Socialite::driver('google')->redirectUrl($redirectRegisterUri)->user();
        $resultBool = $this->registerUser($user);
        if($resultBool) return redirect()->route('home')->with('status','Поздравляем с успешной регистрацией');
        return redirect()->route('login')->with('status','Вы уже у нас зарегистрированы, просто войдите');
    }

    protected function loginUser($data)
    {
        $user = $this->userRepository->getUserByEmail($data);
        if (!$user) {
            return false;
        }
        Auth::login($user);
        return true;
    }

    public function registerUser($data)
    {
        $user = $this->userRepository->getUserByEmail($data);
        if (!$user) {
            $user = $this->userRepository->create($data);
            if(!$user) {
                return false;
            }
            Auth::login($user);
            return true;
        }
        return false;

    }
}
