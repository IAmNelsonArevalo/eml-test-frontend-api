<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UsersRepository;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Traits\CustomResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    use CustomResponses;

    private UsersRepository $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function getUsers(): JsonResponse
    {
        $users = $this->usersRepository->getUsers();
        return $this->success("Done.", $users);
    }

    public function changeStatus(string $id): JsonResponse
    {
        $status = false;
        $result = null;
        $user = null;
        DB::beginTransaction();
        try {
            $user = $this->usersRepository->changeStatus($id);

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollBack();
        }

        if($status) {
            return $this->success("Done.", $user);
        } else {
            return $this->error("Ocurrio un problema al momento de cambiar el estado del usuario.", $result);
        }
    }

    public function updateUser(UpdateUserRequest $request): JsonResponse
    {
        $status = false;
        $result = null;
        $user = null;
        DB::beginTransaction();
        try {
            $user = $this->usersRepository->update($request);

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollBack();
        }

        if($status) {
            return $this->success("Done.", $user);
        } else {
            return $this->error("Ocurrio un problema al momento de actializar la info del usuario.", $result);
        }
    }

    public function deleteUser(string $id): JsonResponse
    {
        $status = false;
        $result = null;
        $user = null;
        DB::beginTransaction();
        try {
            $user = $this->usersRepository->delete($id);

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollBack();
        }

        if($status) {
            return $this->success("Done.", $user);
        } else {
            return $this->error("Ocurrio un problema al momento de borrar la info del usuario.", $result);
        }
    }
}
