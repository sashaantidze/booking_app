<?php

namespace App\Models;

use App\Bookings\Filters\AppointmentFilter;
use App\Bookings\Filters\SlotsPassedTodayFilter;
use App\Bookings\Filters\UnavailabilityFilter;
use App\Bookings\TimeSlotGenerator;
use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Employee extends Model
{
    use HasFactory;

    public function availableTimeSlots(Schedule $schedule, Service $service)
    {
        $slots = (new TimeSlotGenerator($schedule, $service))
            ->applyFilters([
                new SlotsPassedTodayFilter(),
                new UnavailabilityFilter($schedule->unavailabilities),
                new AppointmentFilter($this->appointmentsForDate($schedule->date)),
            ])->get();

        return $slots;
    }


    public function appointmentsForDate(Carbon $date)
    {
        return $this->appointments()->whereDate('date', $date)->get();
    }


    public function services()
    {
        return $this->belongsToMany(Service::class);
    }


    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }


    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
