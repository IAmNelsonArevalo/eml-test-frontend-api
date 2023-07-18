<?php

namespace App\Http\Repositories;

use App\Models\{Status};
use Illuminate\Database\Eloquent\{Collection};

class StatusesRepository implements \App\Http\Interfaces\StatusesInterfaces
{

    /**
     * Get all statuses.
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Status::all();
    }

    /**
     * Get a status by its ID.
     * @param int $id
     * @return Status|null
     */
    public function getById(int $id): ?Status
    {
        return Status::find($id);
    }

    /**
     * Create a new status.
     * @param array $data
     * @return Status
     */
    public function create(array $data): Status
    {
        return Status::create($data);
    }

    /**
     * Update an existing status.
     *
     * @param int $id
     * @param array $data
     * @return Status|null
     */
    public function update(int $id, array $data): ?Status
    {
        $status = $this->getById($id);

        if ($status) {
            $status->update($data);
            return $status;
        }

        return null;
    }


    /**
     * Delete a status.
     * @param int $id
     * @return Status
     */
    public function delete(int $id): Status
    {
        $status = $this->getById($id);

        if ($status) {
            return $status->delete();
        }

        return $status;
    }
}
