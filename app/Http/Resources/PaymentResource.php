<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'payment_uuid' => $this->payment_uuid,
            'invoice_uuid' => $this->invoice_uuid,
            'amount' => $this->amount,
            'method' => $this->method,
            'status' => $this->status,
            'reference_no' => $this->reference_no,
            'paid_at' => $this->paid_at,
            'invoice' => $this->whenLoaded('invoice', function () {
                return [
                    'invoice_uuid' => $this->invoice?->invoice_uuid,
                    'appointment_uuid' => $this->invoice?->appointment_uuid,
                    'total' => $this->invoice?->total,
                    'status' => $this->invoice?->status,
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}