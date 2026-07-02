<?php

namespace App\Services;

use App\Models\AutoNumber;
use Illuminate\Support\Facades\DB;

class AutoNumberService
{
    public function __construct()
    {

    }

    public function generate(string $key): string
    {
        return DB::transaction(function () use ($key) {

            $row = AutoNumber::where('key', $key)->lockForUpdate()->first();

            if (!$row) {
                throw new \Exception("Auto number key not found: {$key}");
            }

            // increment safely
            $row->current_value += $row->increment;
            $row->save();

            // format number
            $number = $row->prefix .
                str_pad($row->current_value, $row->pad_length, '0', STR_PAD_LEFT);

            return $number;
        });
    }
}
