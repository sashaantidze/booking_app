<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Service;
use Carbon\Carbon;
use Livewire\Component;

class CreateBooking extends Component
{
    public $employees;
    public $state = [
        'service' => null,
        'employee' => null,
        'time' => null,
        'name' => 'names',
        'email' => 'email@email.em',
    ];


    protected $listeners = [
        'updated-booking-time' => 'setTime'
    ];


    public function setTime($time)
    {
        $this->state['time'] = $time;
    }


    protected function rules()
    {
        return [
            'state.service' => 'required|exists:services,id',
            'state.employee' => 'required|exists:employees,id',
            'state.time' => 'required|numeric',
            'state.name' => 'required|string',
            'state.email' => 'required|string',
        ];
    }


    public function createBooking()
    {
        $this->validate();

        $theBooking = [
            'date' => $this->timeObject->toDateString(),
            'start_time' => $this->timeObject->toTimeString(),
            'end_time' => $this->timeObject->clone()->addMinutes($this->selectedService->duration)->toTimeString(),
            'client_name' => $this->state['name'],
            'client_email' => $this->state['email'],
        ];


        $appointment = Appointment::make($theBooking);

        $appointment->service()->associate($this->selectedService);

        $appointment->employee()->associate($this->selectedEmployee);        

        $appointment->save();
    }



    public function getTimeObjectProperty()
    {
        return Carbon::createFromTimestamp($this->state['time']);
    }


    public function mount()
    {
        $this->employees = collect();
    }


    public function updatedStateService($serviceId)
    {
        $this->state['employee'] = null;
        $this->clearStateTime();

        if(!$serviceId){
            $this->employees = collect();
            return;
        }


        $this->employees = $this->selectedService->employees;
    }


    public function updatedStateEmployee()
    {
        $this->clearStateTime();
    }


    public function clearStateTime()
    {
        $this->state['time'] = null;
    }


    public function getSelectedServiceProperty()
    {
        if(!$this->state['service']){
            return null;
        }

        return Service::find($this->state['service']);
    }


    public function getSelectedEmployeeProperty()
    {
        if(!$this->state['employee']){
            return null;
        }

        return Employee::find($this->state['employee']);
    }


    public function getHasDetailsToBookProperty()
    {
        return $this->state['service'] && $this->state['employee'] && $this->state['time'];
    }


    public function render()
    {
        $services = Service::get();
        return view('livewire.create-booking', ['services' => $services])->layout('layouts.guest');
    }
}
