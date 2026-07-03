<?php
namespace App\DTO\Services;

use App\Http\Requests\ServicesRequest;

class UpdateServicesDTO
{
    public function __construct(
        public readonly string $service_name,
        public readonly string $service_category,
        public readonly int $service_price,
        public readonly ?string $service_description,
        public readonly string $service_active,
        public readonly ?string $appointment_uuid,
    ){}

    public static function fromUpdateRequest(ServicesRequest $request)
    {
        return new self(
            service_name: $request->service_name,
            service_category: $request->service_category,
            service_price: $request->service_price,
            service_description: $request->service_description,
            service_active: $request->service_active,
            appointment_uuid: $request->appointment_uuid
        );
    }
}
