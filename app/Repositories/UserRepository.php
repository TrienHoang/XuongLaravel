<?php 

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::with(['role'])->paginate(10);
    }

    public function findById($id)
    {
        return User::with(['role'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        return User::destroy($id);
    }
}
