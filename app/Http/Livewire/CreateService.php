<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class CreateService extends Component
{


    public $state = [
        'service' => null,
        'duration' => null,
    ];


    protected function rules()
    {
        return [
            'state.service' => 'required|string',
            'state.duration' => 'required|numeric|between:15,180',
        ];
    }


    public function createService()
    {
        $this->validate();

        $service = new Service();

        $service->name = $this->state['service'];

        $service->duration = $this->state['duration'];

        $service->save();

        return redirect()->to(route('schedule.create'));
    }


    public function render()
    {
        return view('livewire.create-service')->layout('layouts.guest');
    }
}
