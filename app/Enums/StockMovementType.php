<?php

namespace App\Enums;

enum StockMovementType: string
{
    case IN = 'in';
    case OUT = 'out';
    case ADJUSTMENT = 'adjustment';
    case RETURN = 'return';
    case EXPIRED = 'expired';
    case DAMAGED = 'damaged';
}
