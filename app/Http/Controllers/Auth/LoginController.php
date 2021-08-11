<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

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

    public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback() {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {
                if($finduser->status=='Active'){
                    Auth::login($finduser);
                    return redirect('/home');
                }else{
                    return route('login');
                }
            } else {
                $newUser = User::create(['name' => $user->name, 'email' => $user->email, 'facebook_id' => $user->id]);
                Auth::login($newUser);
                return redirect()->back();
            }
        }
        catch(Exception $e) {
            return redirect('auth/facebook');
        }
    }

    protected function redirectTo()
    {
        $user = auth()->user();
        if ($user->user_type == 'User') {
            if($user->status == 'Active'){
                return route('home');
            }else {
                return route('login');
            }
        } else {
            return route('dashboard');
        }
    }
}
