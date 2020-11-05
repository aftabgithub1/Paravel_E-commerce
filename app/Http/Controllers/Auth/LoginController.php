<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Carbon\Carbon;
use Auth;
use Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
    }



    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        $githubuser = User::where('provider_id', $user->getId())->first();

        // dd($user);
        // die();
        if (!$githubuser){
            User::create([
                'name' => $user->getNickname(),
                'email' => $user->getEmail(),
                'password' => bcrypt('abc@1234'),
                'provider_id' => $user->getId(),
                'created_at' => Carbon::now()
            ]);
    
            if (Auth::attempt(['email' => $user->getEmail(), 'password' => 'abc@1234'])){
                return redirect('/');
            }
        }
        
        if (Auth::attempt(['email' => $user->getEmail(), 'password' => 'abc@1234'])){
            return redirect('/');
        }

    }
}
