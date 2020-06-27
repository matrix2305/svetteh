<?php

namespace App\Http\Controllers;

use AppCore\Interfaces\IUsersService;
use Illuminate\Http\Request;

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
            'rolename' => 'required'
        ]);
        $data = $request->all();
        $check = $this->usersService->findRoleByName($data['rolename']);
        if(empty($check)){
            $inputp = array_diff($data, ['_token', '_method', 'rolename', 'rolecolor']);
            $permissions = array();
            for($i = 0; $i<count($inputp); $i++){

                if(!empty($inputp['permission'.$i])){
                    $permissions[] = array(
                        'id' => $inputp['permission'.$i]
                    );
                }
            }
            $this->usersService->addRole([
                'name' => $data['rolename'],
                'color' => $data['rolecolor'],
                'permissions' => $permissions
            ]);
            return redirect()->route('roles')->with('success', 'Uspešno dodavanje role!');
        }else{
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
        $request->validate([
            'id' => 'required'
        ]);
        $this->usersService->deleteRole($request->input('id'));
        return redirect()->route('roles')->with('deleted', 'Uspešno obrisano učešće!');
    }
}
