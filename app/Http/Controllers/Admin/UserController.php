<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller{
    public function listUser() {
        $listUser = User::all();
        return view('admin.users.list-user')->with([
            'listUser' => $listUser
        ]);
    }

    public function addUser() {
        $listRole = Role::all();
        return view('admin.users.add-user')->with([
            'listRole' => $listRole
        ]);
    }
    
}