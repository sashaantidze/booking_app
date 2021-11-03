<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Service;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Livewire\Component;

class CreateSchedule extends Component
{

    public const INCREMENT = 15;

    public $date;
    public $services;
    public $calendarStartDate;
    public $defaultStartTime;
    public $defaultEndTime;
    public $timeSlot;

    public $state = [
        'employee' => null,
        'service' => null,
        'start_time' => null,
    ];


    public function mount()
    {
        $this->setDate(now()->timestamp);
        $this->calendarStartDate = now();
        $this->services = collect();

        $this->defaultStartTime = '08:00';
        $this->defaultEndTime = '23:00';
    }


    public function updatedtimeSlot($time)
    {
        $this->timeSlot = $time;
        $this->state['start_time'] = $time;
    }


    public function updatedStateEmployee($employee_id)
    {
        $this->state['service'] = null;
        if(!$employee_id){
            $this->services = collect();
            return;
        }


        $employee_services = $this->selectedEmployee->services;
        $this->services = $this->allServices->diff($employee_services);

    }


    public function getAllservicesProperty()
    {
        return Service::get();
    }


    public function getSelectedEmployeeProperty()
    {
        if(is_null($this->state['employee'])){
            return null;
        }

        return Employee::find($this->state['employee']);
    }


    public function getSelectedServiceProperty()
    {
        if(is_null($this->state['service'])){
            return null;
        }

        return Service::find($this->state['service']);
    } 


    public function getCalendarSelectedDateObjectProperty()
    {
        return Carbon::createFromTimestamp($this->date);
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


    public function setDate($timestamp)
    {
        $this->date = $timestamp;
        // dump($this->calendarSelectedDateObject->setTimeFrom($this->defaultStartTime));
        // dd($this->calendarSelectedDateObject->setTimeFrom($this->defaultEndTime));

        //dd($this->scheduleCheck);
    }


    public function getScheduleCheckProperty()
    {
        return Schedule::whereDate('date', $this->calendarSelectedDateObject)->count();
    }


    public function getTimeSlotsForDateProperty()
    {
        $start = $this->calendarSelectedDateObject->setTimeFrom($this->defaultStartTime);
        $end = $this->calendarSelectedDateObject->clone()->setTimeFrom($this->defaultEndTime);

        return CarbonInterval::minutes(self::INCREMENT)->toPeriod($start, $end);
    }


    public function render()
    {

        $view_vars = [
            'employees' => Employee::get(),
        ];

        return view('livewire.create-schedule', $view_vars)->layout('layouts.guest');
    }
}
