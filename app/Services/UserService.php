<?php 

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAllUsers()
    {
        return $this->userRepo->getAll();
    }

    public function getUserById($id)
    {
        return $this->userRepo->findById($id);
    }

    public function createUser(array $data, $file = null)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        if ($file) {
            $fileUpload = $this->userRepo->storeFile($file);
            $data['avatar'] = $fileUpload->id;
        }

        return $this->userRepo->create($data);
    }

    public function updateUser($id, array $data, $file = null)
    {
        $user = $this->userRepo->findById($id);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // Không update nếu để trống
        }

        if ($file) {
            // Delete old avatar if exists
            if ($user->avatarFile) {
                $this->userRepo->deleteFile($user->avatarFile);
            }
            // Store new avatar
            $fileUpload = $this->userRepo->storeFile($file);
            $data['avatar'] = $fileUpload->id;
        }

        return $this->userRepo->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepo->delete($id);
    }
}
