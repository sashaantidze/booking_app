<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\Service;
use Livewire\Component;

class CreateSchedule extends Component
{

    public $services;

    public $state = [
        'employee' => null,
        'service' => null,
    ];


    public function mount()
    {
        $this->services = collect();
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


    public function render()
    {

        $view_vars = [
            'employees' => Employee::get(),
        ];

        return view('livewire.create-schedule', $view_vars)->layout('layouts.guest');
    }
}
