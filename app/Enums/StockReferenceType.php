<?php

namespace App\Enums;

enum StockReferenceType: string
{
    case PURCHASE = 'purchase';
    case APPOINTMENT = 'appointment';
    case MANUAL = 'manual';
    case SYSTEM = 'system';
}
