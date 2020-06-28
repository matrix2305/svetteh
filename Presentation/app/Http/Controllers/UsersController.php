<?php

namespace App\Http\Controllers;

use AppCore\Interfaces\IUsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;

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
        $user = $this->usersService->getOneUser(intval($id));
        $roles = $this->usersService->getAllRoles();
        return view('edituser', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate(
            [
                'id' => 'required|integer',
                'lastavatar' => 'required|string:30',
                'avatar' => 'image|mimes:jpg,png,svg,bmp,jpeg|max:4096',
                'username' => 'required|string:30',
                'name' => 'string:30',
                'lastname' => 'string:50',
                'email' => 'required|email',
                'role' => 'required|integer',
                'password' => 'min:8|confirmed',
            ]
        );

        try {
            if ($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                unlink(public_path('/images/avatar'.$request->input('lastavatar')));
                $extension = $avatar->getExtension();
                $avatar_name = time().$extension;
                $avatar->move(public_path('/images/avatars/'.$avatar_name));
            }else{
                $avatar_name = null;
            }

            $this->usersService->updateUser(
                [
                    'id' => $request->input('id'),
                    'avatar' => $avatar_name,
                    'username' => $request->input('username'),
                    'name' => $request->input('name'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                    'role_id' => $request->input('role'),
                    'password' => Hash::make($request->input('password'))
                ]
            );

            return redirect()->route('users')->with('success', 'Uspešne izmene!');
        }catch (Exception $exception){
            return redirect()->back()->with('error', 'Neuspešne izmene!');
        }

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
               'id' => 'required',
               'avatar' => 'required|string'
           ]
       );
        try {
            if(file_exists(public_path('/images/avatars/'.$request->input('avatar')))){
                unlink(public_path('/images/avatars/'.$request->input('avatar')));
            }

            $this->usersService->deleteUser($request->input('id'));
            return redirect()->route('users')->with('deleted', 'Uspešno obrisan korisnik!');
        }catch (Exception $exception){
            return redirect()->back()->with('error', 'Došlo je do problema sa brisanjem!');
        }
    }
}
