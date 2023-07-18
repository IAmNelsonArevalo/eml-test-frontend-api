<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\{AuthInterfaces};
use Carbon\Carbon;
use App\Models\{DocumentType, User};
use Illuminate\Database\Eloquent\{Collection};
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterfaces
{

    public function getDocumentTypes(): Collection
    {
        return DocumentType::where("status_id", 1)->get();
    }

    public function create(array $data): User
    {
        $user = new User();
        $user["uid"] = Hash::make($data["email"]);
        $user["name"] = $data["name"];
        $user["last_name"] = $data["last_name"];
        $user["email"] = $data["email"];
        $user["password"] = Hash::make($data["password"]);
        $user["document_type_id"] = $data["document_type"];
        $user["document"] = $data["document"];
        $user["phone"] = $data["phone"];
        $user["status_id"] = 1;
        $user["verified_account"] = Carbon::now()->format("Y-m-d h-i-s");
        $user->save();

        $user->assignRole($data["role"]);

        return $user;
    }

    public function changePassword(array $data): User
    {
        $user = User::where("email", $data["email"])->first();
        $user->password = Hash::make($data["password"]);
        $user->save();

        return $user;
    }
}
