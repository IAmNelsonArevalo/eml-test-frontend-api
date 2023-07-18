<?php

namespace App\Http\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\{Collection};

interface AuthInterfaces
{
    public function getDocumentTypes(): Collection;
    public function create(array $data): User;
    public function changePassword(array $data): User;
}
