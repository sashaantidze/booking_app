<div class="bg-gray-200 max-w-sm mx-auto m-6 p-5 rounded-lg">
    
    <form action="">

        <div class="mb-6">
            <label for="service" class="inline-block text-gray-700 font-blod mb-2">Select service</label>
            <select name="" id="service" class="bg-white h-10 w-full border-none rounded-lg" wire:model="state.service">
                <option value="">Select a Service</option>
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->name}} ({{$service->duration}}m)</option>
                @endforeach
            </select>
        </div>

        <label for="employee" class="inline-block text-gray-700 font-blod mb-2">Select employee</label>
        <select name="" id="employee" class="bg-white h-10 w-full border-none rounded-lg" wire:model="state.employee">
            <option value="">Select an employee</option>
                @foreach($employees as $employee)
                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                @endforeach
        </select>
        
    </form>

</div>