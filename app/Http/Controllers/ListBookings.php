<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class ListBookings extends Controller
{
    public function __invoke()
    {
        $appointments = Appointment::NotCancelled()->orderby('date', 'desc')->get();

        return [
            'data' => $appointments
        ];
    }
}
