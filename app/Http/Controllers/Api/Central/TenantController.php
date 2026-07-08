<?php

namespace App\Http\Controllers\Api\Central;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Stancl\Tenancy\Database\Models\Tenant;
use Stancl\Tenancy\Database\Models\Domain;

use App\Models\Tenant as TenantModel;

class TenantController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'clinic_name'=>'required|string|max:255',
            'clinic_code'=>'nullable|string|max:50',
            'clinic_email'=>'nullable|email',
            'clinic_phone'=>'nullable|string|max:20',
            'clinic_address1'=>'nullable|string|max:255',
            'clinic_address2'=>'nullable|string|max:255',
            'clinic_city'=>'nullable|string|max:100',
            'clinic_state'=>'nullable|string|max:100',
            'clinic_postcode'=>'nullable|string|max:20',
            'clinic_country'=>'nullable|string|max:100',
            'domain'=>'required|string|max:50|unique:domains,domain',
        ]);

        DB::beginTransaction();

        try {
            /*
            |--------------------------------------------------------------------------
            | Create Tenant
            |--------------------------------------------------------------------------
            */
            $tenantId = Str::slug($request->clinic_name);
            $tenant = TenantModel::create([
                'id' => $tenantId,
                'clinic_name'=>$request->clinic_name,
                'clinic_code'=>$request->clinic_code,
                'clinic_email'=>$request->clinic_email,
                'clinic_phone'=>$request->clinic_phone,
                'clinic_address1'=>$request->clinic_address1,
                'clinic_address2'=>$request->clinic_address2,
                'clinic_city'=>$request->clinic_city,
                'clinic_state'=>$request->clinic_state,
                'clinic_postcode'=>$request->clinic_postcode,
                'clinic_country'=>$request->clinic_country,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Create Domain
            |--------------------------------------------------------------------------
            */
            Domain::create([
                'domain'=>$request->domain.'.yourapp.com',
                'tenant_id'=>$tenant->id
            ]);

            return response()->json([
                'message'=>'Tenant created successfully',
                'tenant'=>[
                    'id'            => $tenant->id,
                    'name'          => $tenant->clinic_name,
                    // 'domain'        => $request->domain.'.yourapp.com'
                    'domain'        => $request->domain.'.localhost'
                ]
            ],201);
        } catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'message'=>'Failed creating tenant',
                'error'=>$e->getMessage()
            ],500);
        }
    }
}
