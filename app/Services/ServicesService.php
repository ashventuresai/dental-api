<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Services;
use App\DTO\Services\CreateServicesDTO;
use App\DTO\Services\UpdateServicesDTO;

class ServicesService
{
    public function __construct()
    {

    }

    public function getAll($search = null)
    {
        return Services::query()->when($search,function($q) use ($search){
                $q->where('service_name','like',"%$search%")
                    ->orWhere('service_code','like',"%$search%")
                    ->orWhere('service_category','like',"%$search%");
            })
            ->orderBy('service_name')
            // ->paginate(15);
            ->get();
    }

    public function findByUUID($uuid)
    {
        return Services::where('service_uuid', $uuid)->firstOrFail();
    }

    public function create(CreateServicesDTO $dto)
    {
        return Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>$dto->service_code,
            'service_name'=>$dto->service_name,
            'service_category'=>$dto->service_category,
            'service_price'=>$dto->service_price,
            'service_description'=>$dto->service_description,
            'service_active'=>$dto->service_active
        ]);
    }

    public function update($uuid, UpdateServicesDTO $dto)
    {
        $service = $this->findByUUID($uuid);

        $service->update([
            'service_name'=>$dto->service_name,
            'service_category'=>$dto->service_category,
            'service_price'=>$dto->service_price,
            'service_description'=>$dto->service_description,
            'service_active'=>$dto->service_active
        ]);

        return $service;
    }

    public function delete($uuid)
    {
        $service = $this->findByUUID($uuid);

        return $service->delete();
    }
}
