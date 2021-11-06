<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Livewire\Component;

class ListBookings extends Component
{
    public function render()
    {
        $appointments = Appointment::NotCancelled()->get();

        return view('livewire.list-bookings', ['appointments' => $appointments])->layout('layouts.guest');
    }
}
