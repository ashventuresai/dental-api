<?php

namespace App\Repositories\Interfaces;

use App\DTO\Treatment\CreateTreatmentDTO;
use App\DTO\Treatment\UpdateTreatmentDTO;

interface TreatmentRepositoryInterface
{
    public function create(CreateTreatmentDTO $dto);
    public function update(string $uuid, UpdateTreatmentDTO $dto);
    public function findByUuid(string $uuid);
}
