<?php

namespace App\Enums;

enum ProductType: string
{
    case MEDICINE = 'medicine';
    case DENTAL_MATERIAL = 'dental_material';
    case CONSUMABLE = 'consumable';
    case EQUIPMENT = 'equipment';
    case SERVICE = 'service';
}
