<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Livewire\Component;

class BookingCalendar extends Component
{

    public $calendarStartDate;

    public $date;

    public $service;

    public $employee;

    public $time;


    public function mount()
    {
        $this->calendarStartDate = now();

        $this->setDate(now()->timestamp);
    }


    public function updatedTime($time)
    {
        $this->emitUp('updated-booking-time', $time);
    }


    public function getCalendarSelectedDateObjectProperty()
    {
        return Carbon::createFromTimestamp($this->date);
    }


    public function getAvailableTimeSlotsProperty()
    {
        if(!$this->employee || !$this->employeeSchedule){
            return collect();
        }

        return $this->employee->availableTimeSlots($this->employeeSchedule, $this->service);
    }


    public function getEmployeeScheduleProperty()
    {
        return $this->employee
            ->schedules()
            ->whereDate('date', $this->calendarSelectedDateObject)
            ->first();
    }


    public function setDate($timestamp)
    {
        $this->date = $timestamp;
    }


    public function getCalnderWeekIntervalProperty()
    {
        return CarbonInterval::days(1)->toPeriod(
            $this->calendarStartDate,
            $this->calendarStartDate->clone()->addDays(6)
        );
    }


    public function incrementCalendarWeek()
    {
        $this->calendarStartDate->addWeek();
    }


    public function decrementCalendarWeek()
    {
        $this->calendarStartDate->subWeek();
    }



    public function getWeekIsGreaterThanCurrentProperty()
    {
        return $this->calendarStartDate->gt(now());
    }


    public function render()
    {
        return view('livewire.booking-calendar');
    }
}
