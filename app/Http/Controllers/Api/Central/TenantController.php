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
    public function show(Request $request)
    {
        $tenant = TenantModel::where('id', $request->header('X-Tenant'))->first();

        if (!$tenant) {
            return response()->json([
                'message' => 'Tenant not found'
            ], 404);
        }

        return response()->json([
            'clinic_name' => $tenant->clinic_name,
            'clinic_legal_name' => $tenant->clinic_legal_name,
            'clinic_registration_no' => $tenant->clinic_registration_no,
            'clinic_code' => $tenant->clinic_code,
            'clinic_email' => $tenant->clinic_email,
            'clinic_phone' => $tenant->clinic_phone,
            'clinic_website' => $tenant->clinic_website,
            'clinic_address1' => $tenant->clinic_address1,
            'clinic_address2' => $tenant->clinic_address2,
            'clinic_address3' => $tenant->clinic_address3,
            'clinic_receipt_footer' => $tenant->clinic_receipt_footer,
            'clinic_invoice_footer' => $tenant->clinic_invoice_footer,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'clinic_name'=>'required|string',
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
            // $tenantId = Str::slug($request->clinic_name);
            $tenant = TenantModel::create([
                // 'id'                    => $tenantId,
                'id'                    => $request->domain,
                'clinic_name'           => $request->clinic_name,
                'clinic_legal_name'     => $request->clinic_legal_name,
                'clinic_code'           => $request->clinic_code,
                'clinic_email'          => $request->clinic_email,
                'clinic_phone'          => $request->clinic_phone,
                'clinic_address1'       => $request->clinic_address1,
                'clinic_address2'       => $request->clinic_address2,
                'clinic_city'           => $request->clinic_city,
                'clinic_state'          => $request->clinic_state,
                'clinic_postcode'       => $request->clinic_postcode,
                'clinic_country'        => $request->clinic_country,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Create Domain
            |--------------------------------------------------------------------------
            */

            if($tenant->clinic_code === "Vercel"){
                $domain = $request->domain.'.vercel.app';
            } else {
                $domain = $request->domain.'.localhost';
            }

            Domain::create([
                'domain'        => $domain,
                'tenant_id'     => $tenant->id
            ]);

            return response()->json([
                'message'=>'Tenant created successfully',
                'tenant'=>[
                    'tenant_id'     => $tenant->id,
                    'clinic_name'   => $tenant->clinic_name,
                    'domain'        => $domain
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
