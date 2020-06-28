<?php

function permission($input){
    $permissions = \Illuminate\Support\Facades\Auth::user()->getRole()->getPermissions();
    foreach ($permissions as $permission){
        if($permission->getPermission() == $input){
            return true;
        }
    }
    return false;
}
