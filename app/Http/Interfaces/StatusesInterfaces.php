<?php

namespace App\Http\Interfaces;

use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;

interface StatusesInterfaces
{
    /**
     * Get all statuses.
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Get a status by its ID.
     *
     * @param int $id
     * @return Status|null
     */
    public function getById(int $id): ?Status;

    /**
     * Create a new status.
     *
     * @param array $data
     * @return Status
     */
    public function create(array $data): Status;

    /**
     * Update an existing status.
     *
     * @param int $id
     * @param array $data
     * @return Status|null
     */
    public function update(int $id, array $data): ?Status;

    /**
     * Delete a status.
     *
     * @param int $id
     * @return Status
     */
    public function delete(int $id): Status;
}
