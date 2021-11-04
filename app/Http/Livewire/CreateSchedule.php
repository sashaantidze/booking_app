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

    public const INCREMENT = 60;

    public $date;
    public $shift;
    public $services;
    public $calendarStartDate;
    public $defaultStartTime;
    public $defaultEndTime;
    public $timeSlot;

    public $state = [
        'employee' => null,
        'service' => null,
        'start_time' => null,
        'shift' => null,
    ];


    public function mount()
    {
        $this->setDate(now()->timestamp);
        $this->calendarStartDate = now();
        $this->services = collect();

        $this->shift = $this->state['shift'] = '2';
        $this->defaultStartTime = '08:00';
        $this->defaultEndTime = '23:00';
    }



    public function createSchedule()
    {
        $theSchedule = [
            'date' => $this->calendarSelectedDateObject->toDateString(),
            'start_time' => $this->timeObject->toTimeString(),
            'end_time' => $this->timeObject->clone()->addHours($this->shift)->toTimeString(),
        ];


        $this->selectedEmployee->services()->attach($this->selectedService->id);

        $schedule = Schedule::make($theSchedule);

        $schedule->employee()->associate($this->selectedEmployee->id);

        $schedule->save();


        return redirect()->to(route('bookings.create'));
    }



    public function getTimeObjectProperty()
    {
        return Carbon::createFromTimestamp($this->state['start_time']);
    }


    public function getCalendarSelectedDateObjectProperty()
    {
        return Carbon::createFromTimestamp($this->date);
    }


    public function updatedtimeSlot($time)
    {
        $this->timeSlot = $time;
        $this->state['start_time'] = $time;
    }


    public function updatedShift($shift)
    {
        $this->timeSlot = null;
        $this->state['start_time'] = null;
        $this->state['shift'] = $shift;
    }


    public function updatedStateEmployee($employee_id)
    {
        $this->state['service'] = null;
        $this->state['start_time'] = null;
        $this->timeSlot = null;
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
        $this->state['start_time'] = null;
        $this->timeSlot = null;
        $this->date = $timestamp;
    }



    public function getScheduleCheckProperty()
    {
        return Schedule::whereDate('date', $this->calendarSelectedDateObject)
            ->where('employee_id', $this->state['employee'])->count();
    }


    public function getTimeSlotsForDateProperty()
    {
        $start = $this->calendarSelectedDateObject->setTimeFrom($this->defaultStartTime);
        $end = $this->calendarSelectedDateObject->clone()->setTimeFrom($this->defaultEndTime)->subHours($this->shift);

        //dd($end);

        return CarbonInterval::minutes(self::INCREMENT)->toPeriod($start, $end);
    }


    public function getReadyToCreateScheduleProperty()
    {
        return $this->state['service'] &&
                $this->state['employee'] &&
                $this->state['start_time'] &&
                $this->state['shift'];
    }


    public function render()
    {

        $view_vars = [
            'employees' => Employee::get(),
        ];

        return view('livewire.create-schedule', $view_vars)->layout('layouts.guest');
    }
}
