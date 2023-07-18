<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Interfaces\{UsersInterfaces};
use Illuminate\Database\Eloquent\{Collection};

class UsersRepository implements UsersInterfaces
{

    public function getUsers(): Collection
    {
        return User::get();
    }

    public function changeStatus(int $id): User
    {
        $user = User::find($id);
        $user->status_id = $user->status_id === 1 ? 2 : 1;
        $user->save();

        return $user;
    }

    public function update(mixed $data): User
    {
        $user = User::find($data["id"]);
        $user["name"] = $data["name"];
        $user["last_name"] = $data["last_name"];
        $user["email"] = $data["email"];
        $user["document_type_id"] = $data["document_type"];
        $user["document"] = $data["document"];
        $user["phone"] = $data["phone"];
        $user->save();

        return $user;
    }

    public function delete(string $id): User
    {
        $user = User::find($id);
        $user->delete();

        return $user;
    }
}
