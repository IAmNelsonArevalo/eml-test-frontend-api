<?php

namespace App\Http\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UsersInterfaces
{
    public function getUsers(): Collection;
    public function changeStatus(int $id): User;
    public function update(mixed $data): User;

    public function delete(string $id): User;
}
