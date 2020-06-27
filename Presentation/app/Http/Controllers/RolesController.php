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
            'rolename' => 'required|string|max:50'

        ]);
        $data = $request->all();
        unset($data['_token'], $data['rolename'],$data['rolecolor'], $data['_method']);
        try{
            $permissions = array_values($data);
            $this->usersService->addRole([
                'name' => $request->input('rolename'),
                'color' => $request->input('rolecolor'),
                'permissions' => $permissions
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
        dd($role);
        return view('editrole', ['role' => $role]);
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
        $request->validate([
            'id' => 'required|integer'
        ]);
        $id = $request->input('id');
        $this->usersService->deleteRole(intval($id));
        return redirect()->route('roles')->with('deleted', 'Uspešno obrisano učešće!');
    }
}
