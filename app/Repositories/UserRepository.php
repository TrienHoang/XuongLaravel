<?php 

namespace App\Repositories;

use App\Models\UploadFile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    protected $model;
    public function __construct(User $user){
        $this->model = $user;
    }
    public function getAll()
    {
        return User::with('role','avatarFile')->orderBy('id','desc')->paginate(5);
    }

    public function findById($id)
    {
        return User::with(['role','avatarFile'])->findOrFail($id);
    }

    public function create(array $data): User
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // Hash the password
            'phone_number' => $data['phone_number'] ?? null,
            'address' => $data['address'] ?? null,
            'status' => $data['status'],
            'role_id' => $data['role_id'],
            'avatar' => $data['avatar'] ?? null, // Store the image ID if an avatar is uploaded
        ];

        return User::create($userData);
    }

    public function storeFile($file)
    {
        $path = $file->store('avatars', 'public');
        return UploadFile::create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(), // Lấy loại file (image/jpeg, image/png, ...)
            'user_id' => Auth::id(), // Lấy ID của user đang đăng nhập
        ]);
    }
    
    public function update($id, array $data)
    {
        $user = $this->findById($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->findById($id);
        // Delete associated avatar file
        if ($user->avatarFile) {
            Storage::disk('public')->delete($user->avatarFile->file_path);
            $user->avatarFile->delete();
        }
        $user->delete();
        return true;
    }


    public function deleteFile($file)
{
    if (!$file) return;

    Storage::disk('public')->delete($file->file_path);
    $file->delete();
}
}
