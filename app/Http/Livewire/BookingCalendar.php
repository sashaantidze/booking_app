<?php

namespace App\Http\Livewire;

use Carbon\CarbonInterval;
use Livewire\Component;

class BookingCalendar extends Component
{

    public $calendarStartDate;
    public $date;


    public function mount()
    {
        $this->calendarStartDate = now();
        $this->setDate(now()->timestamp);
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
