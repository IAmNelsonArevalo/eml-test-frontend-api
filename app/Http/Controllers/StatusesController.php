<?php

namespace App\Http\Controllers;

use App\Http\Traits\CustomResponses;
use Illuminate\Support\Facades\{DB};
use App\Http\Repositories\{StatusesRepository};
use App\Http\Requests\Status\{CreateStatusRequest};
use Illuminate\Http\{JsonResponse};

class StatusesController extends Controller
{
    use CustomResponses;

    private StatusesRepository $statusesRepository;


    public function __construct(StatusesRepository $statusesRepository)
    {
        $this->statusesRepository = $statusesRepository;
    }

    public function createStatus(CreateStatusRequest $request): JsonResponse
    {
        $status = false;
        $newStatus = null;
        $result = null;
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $newStatus = $this->statusesRepository->create($data);

            DB::commit();

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollBack();
        }

        if($status) {
            return $this->success("Done.", $newStatus);
        } else {
            return $this->error("Error.", $result);
        }
    }

    public function editStatus(CreateStatusRequest $request): JsonResponse
    {
        $status = false;
        $newStatus = null;
        $result = null;
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $id = $request->id;
            $newStatus = $this->statusesRepository->update($id, $data);

            DB::commit();

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollBack();
        }

        if($status) {
            return $this->success("Done.", $newStatus);
        } else {
            return $this->error("Ocurrio un problema al momento de editar el usuario.", $result);
        }
    }

    public function deleteStatus(string $id): JsonResponse
    {
        $status = false;
        $newStatus = null;
        $result = null;
        DB::beginTransaction();
        try {
            $newStatus = $this->statusesRepository->delete($id);

            DB::commit();

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollBack();
        }

        if($status) {
            return $this->success("Done.", $newStatus);
        } else {
            return $this->error("Ocurrio un problema al momento de eliminar el estado.", $result);
        }
    }

    public function getStatuses(): JsonResponse
    {
        $statuses = $this->statusesRepository->getAll();
        return $this->success("Done.", $statuses);
    }
}
