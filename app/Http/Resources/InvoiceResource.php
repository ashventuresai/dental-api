<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'invoice_uuid' => $this->invoice_uuid,
            'appointment_uuid' => $this->appointment_uuid,
            'patient_uuid' => $this->patient_uuid,
            'subtotal' => $this->subtotal,
            'discount' => $this->discount,
            'total' => $this->total,
            'status' => $this->status,
            'issued_at' => $this->issued_at,
            'appointment' => $this->whenLoaded('appointment', function () {
                return [
                    'appointment_uuid' => $this->appointment?->appointment_uuid,
                    'patient_uuid' => $this->appointment?->patient_uuid,
                    'staff_uuid' => $this->appointment?->staff_uuid,
                    'appointment_datetime' => $this->appointment?->appointment_datetime,
                    'status' => $this->appointment?->status,
                ];
            }),
            'items' => $this->relationLoaded('items') ? InvoiceItemResource::collection($this->items) : [],
            'payments' => $this->relationLoaded('payments') ? PaymentResource::collection($this->payments) : [],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}