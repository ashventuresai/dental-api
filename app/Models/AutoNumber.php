<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoNumber extends Model
{
    protected $table = 'tblautonumbers';

    protected $fillable = [
        'key',
        'prefix',
        'current_value',
        'pad_length',
        'increment',
    ];
}
