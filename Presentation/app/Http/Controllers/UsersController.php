<?php

namespace App\Http\Controllers;

use AppCore\Interfaces\IUsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    private IUsersService $usersService;

    public function __construct(IUsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->usersService->getAllUsers();
        $roles = $this->usersService->getAllRoles();
        return view('users', ['users' => $users, 'roles' =>  $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:30',
            'email' => 'required|string|email|max:70',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'string|max:50',
            'lastname' => 'string|max:50',
            'role' => 'required'
        ]);
        $data = $request->all();
        $user = $this->usersService->register($data['username']);

        if(empty($user)){
            $this->usersService->addUser([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => (!empty($data['name']))? $data['name'] : null,
                'lastname' => (!empty($data['lastname']))? $data['lastname'] : null,
                'role_id' => $data['role']
            ]);

            return redirect()->route('users')->with('success', 'Uspešno dodat korisnik!');
        }else{
            return redirect()->route('users')->with('error', 'Korisnik sa ovim korisničkim imenom ili e-poštom već postoji!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $request->validate(
           [
               'id' => 'required'
           ]
       );

       $this->usersService->deleteUser($request->input('id'));
       return redirect()->route('users')->with('deleted', 'Uspešno obrisan korisnik!');
    }
}
