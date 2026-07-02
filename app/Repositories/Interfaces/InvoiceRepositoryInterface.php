<?php

namespace App\Repositories\Interfaces;

interface InvoiceRepositoryInterface
{
    public function all(array $filters = []);
    public function findByUuid(string $invoiceUuid);
    public function create(array $data);
    public function addItems(string $invoiceUuid, string $appointmentUuid, array $items): void;
}
