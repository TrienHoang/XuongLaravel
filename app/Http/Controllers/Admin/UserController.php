<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $listUser = $this->userService->getAllUsers();
        return view('admin.users.list-user', compact('listUser'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.add-user', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->createUser($request->validated());
        return redirect()->route('admin.users.listUser')->with('success', 'User created!');
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        $roles = Role::all();
        return view('admin.users.update-user', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $this->userService->updateUser($id, $request->validated());
        return redirect()->route('admin.users.listUser')->with('success', 'User updated!');
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return redirect()->route('admin.users.listUser')->with('success', 'User deleted!');
    }
}
