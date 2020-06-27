<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use AppCore\Interfaces\IUsersService;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @var $username
     * Login username to be used by controller
     */
    protected $username;

    private IUsersService $UsersService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IUsersService $usersService)
    {
        $this->middleware('guest')->except('logout');
        $this->UsersService = $usersService;
        if(Auth::check()){
            redirect()->route('dashboard');
        }
    }

    public function login(Request $request)
    {
        try {
            $this->UsersService->login($request->input('username'));
            $login_type = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $request->merge([
                $login_type => $request->input('username'),
            ]);
            $credentials = array_merge($request->only($login_type, 'password'));
            $remember = $request->has('remember');

            if (Auth::attempt($credentials, $remember)) {
                return redirect($this->redirectTo);
            }else{
                return redirect()->route('login')
                    ->with('error','Niste uneli ispravnu lozinku!');
            }
        }catch (Exception $exception){
            return redirect()->route('login')
                ->with('error','Korisnik sa ovim korisničkim imenom ne postoji!');
        }
    }
}
