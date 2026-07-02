<?php

namespace App\Enums;

enum AppointmentStatus: string
{
    case BOOKED = 'Booked';
    case PATIENT_WAITING = 'Patient Waiting';
    case IN_TREATMENT = 'In Treatment';
    case PENDING_PAYMENT = 'Pending Payment';
    case Completed = 'Completed';
    case Cancelled = 'Cancelled';
}
