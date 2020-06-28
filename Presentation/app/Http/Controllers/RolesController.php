<?php

namespace App\Http\Controllers;

use AppCore\Interfaces\IUsersService;
use Illuminate\Http\Request;
use Exception;

class RolesController extends Controller
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
        $roles = $this->usersService->getAllRoles();
        $permissions = $this->usersService->getAllPermissions();
        return view('roles', ['permissions' => $permissions, 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rolename' => 'required|string|max:50',
            'permission' => 'required|array|max:20'

        ]);
        try{
            $this->usersService->addRole([
                'name' => $request->input('rolename'),
                'color' => $request->input('rolecolor'),
                'permissions' => $request->input('permission')
            ]);
            return redirect()->route('roles')->with('success', 'Uspešno dodavanje role!');
        }catch (Exception $exception){
            return redirect()->route('roles')->with('error', 'Učešće sa ovim imenom već postoji!');
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
        $role = $this->usersService->findRoleById(intval($id));
        $permissions = $this->usersService->getAllPermissions();
        return view('editrole', ['role' => $role, 'permissions' => $permissions]);
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
                'id' => 'required',
                'name' => 'required|max:50',
                'color' => 'required|max:7',
                'permission' => 'required|array|max:20'
            ]
        );
        try {
            $this->usersService->updateRole([
                'id' => $request->input('id'),
                'name' => $request->input('name'),
                'color' => $request->input('color'),
                'permissions' => $request->input('permission')
            ]);
            return redirect()->route('roles')->with('success', 'Uspešna izmena učešća!');
        }catch (Exception $exception){
            return redirect()->back()->with('error', 'Greška pri izmeni učešća!');
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
        $request->validate([
            'id' => 'required|integer'
        ]);
        $id = $request->input('id');
        $this->usersService->deleteRole(intval($id));
        return redirect()->route('roles')->with('deleted', 'Uspešno obrisano učešće!');
    }
}
