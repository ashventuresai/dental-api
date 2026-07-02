<?php

namespace App\Enums;

enum TreatmentStatus: string
{
    case Draft = 'Draft';
    case Ongoing = 'Ongoing';
    case Completed = 'Completed';
    case Cancelled = 'Cancelled';
}
