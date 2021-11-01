<div class="bg-gray-200 max-w-sm mx-auto m-6 p-5 rounded-lg">
    
    <form action="">
        <div class="mb-6">
            <label for="service" class="inline-block text-gray-700 font-bold mb-2">Select service</label>
            <select name="" id="service" class="bg-white h-10 w-full border-none rounded-lg" wire:model="state.service">
                <option value="">Select a Service</option>
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->name}} ({{$service->duration}}m)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6 {{!$employees->count() ? 'opacity-25' : ''}}">
            <label for="employee" class="inline-block text-gray-700 font-bold mb-2">Select employee</label>
            <select name="" id="employee" class="bg-white h-10 w-full border-none rounded-lg" wire:model="state.employee" {{!$employees->count() ? 'disabled="disabled"' : ''}}>
                <option value="">Select an employee</option>
                    @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                    @endforeach
            </select>
        </div>



        <div class="mb-6 {{!$this->selectedService || !$this->selectedEmployee ? 'opacity-25' : ''}}">
            <label for="employee" class="inline-block text-gray-700 font-bold mb-2">Pick Appointment time</label>

            <livewire:booking-calendar :service="$this->selectedService" :employee="$this->selectedEmployee" :key="optional($this->selectedEmployee)->id" />
        </div>




        
    </form>

</div>