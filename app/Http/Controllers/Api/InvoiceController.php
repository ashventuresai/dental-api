<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\InvoiceService;
use App\DTO\Invoice\CreateInvoiceDTO;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\InvoiceResource;

class InvoiceController extends Controller
{
    public function __construct(protected InvoiceService $invoiceService)
    {
    }

    public function index(Request $request)
    {
        return InvoiceResource::collection($this->invoiceService->list($request->all()));
    }

    public function store(InvoiceRequest $invoiceRequest)
    {
        return new InvoiceResource($this->invoiceService->create(
            CreateInvoiceDTO::fromCreateRequest($invoiceRequest)
        ));
    }

    public function show(string $invoice_uuid)
    {
        return new InvoiceResource($this->invoiceService->getByUuid($invoice_uuid));
    }
}
