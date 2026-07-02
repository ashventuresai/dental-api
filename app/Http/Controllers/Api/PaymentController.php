<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\PaymentService;
use App\DTO\Payment\CreatePaymentDTO;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;

class PaymentController extends Controller
{
    public function __construct(protected PaymentService $paymentService)
    {
    }

    public function index(Request $request)
    {
        return PaymentResource::collection($this->paymentService->list($request->all()));
    }

    public function store(PaymentRequest $paymentRequest)
    {
        return new PaymentResource($this->paymentService->pay(
            CreatePaymentDTO::fromCreateRequest($paymentRequest)
        ));
    }

    public function pay(PaymentRequest $paymentRequest)
    {
        return $this->store($paymentRequest);
    }

    public function show(string $payment_uuid)
    {
        return new PaymentResource($this->paymentService->getByUuid($payment_uuid));
    }
}
