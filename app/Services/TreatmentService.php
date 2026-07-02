<?php

namespace App\Services;

use App\DTO\Treatment\CreateTreatmentDTO;
use App\DTO\Treatment\UpdateTreatmentDTO;
use App\Repositories\Interfaces\TreatmentRepositoryInterface;

class TreatmentService
{

    protected $repository;

    public function __construct(TreatmentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(CreateTreatmentDTO $dto)
    {
        return $this->repository->create($dto);
    }

    public function update(string $uuid, UpdateTreatmentDTO $dto)
    {
        return $this->repository->update($uuid, $dto);
    }

    public function getByUuid(string $uuid)
    {
        return $this->repository->findByUuid($uuid);
    }
}
