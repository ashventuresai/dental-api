<?php

namespace App\Repositories\Interfaces;

interface PaymentRepositoryInterface
{
    public function all(array $filters = []);
    public function findByUuid(string $paymentUuid);
    public function create(array $data);
    public function getTotalPaid(string $invoiceUuid);
}
