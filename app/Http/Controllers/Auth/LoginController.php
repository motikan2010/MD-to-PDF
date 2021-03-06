<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')
            ->setScopes(['read:user', 'repo'])
            //->setScopes(['public_repo'])
            ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        Session::put('user', ['name' => $user->getName(), 'token' => $user->token]);
        return redirect()->route('index');
    }

    /**
     *
     */
    public function logout() {
        Session::put('user', null);
        return redirect()->route('index');
    }

}
