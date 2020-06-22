<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use AppCore\Entities\User;
use AppCore\Interfaces\IUserService;
use AppCore\Services\UsersService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    private UsersService $UsersService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->UsersService = new UsersService();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:30', 'unique:AppCore\Entities\User'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:AppCore\Entities\User'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['string', 'max:255'],
            'lastname' => ['string', 'max:255']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return string
     */
    protected function create(array $data)
    {
        return $this->UsersService->AddUser(
            [
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => (!empty($data['name']))? $data['name'] : null,
                'lastname' => (!empty($data['lastname']))? $data['lastname'] : null
            ]
        );
    }
}
