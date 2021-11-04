<div class="bg-gray-200 max-w-sm mx-auto m-6 p-5 rounded-lg">
    <p class="text-center text-gray-700 text-xl font-bold mb-2">Create Schedule</p>
    <form>

        {{var_dump($state)}}

        <div class="mb-6">
            <label for="employee" class="inline-block text-gray-700 font-bold mb-2">Select an employee</label>
            <select name="" id="employee" class="bg-white h-10 w-full border-none rounded-lg" wire:model="state.employee">
                <option value="">Select an employee</option>
                @foreach($employees as $employee)
                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6 {{!$services->count() ? 'opacity-25' : ''}}">
            <label for="service" class="inline-block text-gray-700 font-bold mb-2">Select service</label>
            <select name="" id="service" class="bg-white h-10 w-full border-none rounded-lg" wire:model="state.service" {{!$services->count() ? 'disabled="disabled"' : ''}}>
                <option value="">Select service</option>
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->name}} ({{$service->duration}}min)</option>
                @endforeach
            </select>
        </div>




        <div class="mb-6 {{!$this->selectedService || !$this->selectedEmployee ? 'invisible' : ''}}">


            <div class="mb-6">
                <label for="shift" class="inline-block text-gray-700 font-bold mb-2">Select shift duration</label>

                <select name="" id="shift" class="bg-white h-10 w-full border-none rounded-lg" wire:model="shift">
                    <option value="2">2 hours</option>
                    <option value="4">4 hours</option>
                    <option value="6">6 hours</option>
                    <option value="8">8 hours</option>
                    <option value="10">10 hours</option>
                    <option value="12">12 hours</option>
                </select>
            </div>


            <div class="bg-white rounded-lg">
                
                <div class="flex items-center justify-center relative">

                    @if($this->WeekIsGreaterThanCurrent)
                        <button type="button" class="p-4 absolute left-0 top-0" wire:click="decrementCalendarWeek">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300 hover:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                    @endif



                    <div class="text-lg font-semibold p-4">
                        {{$this->calendarStartDate->format('M Y')}}
                    </div>


                    <button type="button" class="p-4 absolute right-0 top-0" wire:click="incrementCalendarWeek">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300 hover:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                </div>



                <div class="flex justify-between items-center px-3 border-b border-gray-200 pb-2">

                    @foreach($this->calnderWeekInterval as $day)
                        
                        <button type="button" class="text-center group cursor-pointer focus:outline-none" wire:click="setDate({{$day->timestamp}})">

                            <div class="text-xs leading-none mb-2 text-gray-700">{{$day->format('D')}}</div>

                            <div class="{{$date === $day->timestamp ? 'bg-gray-300' : ''}} text-lg leading-none p-1 rounded-full w-9 h-9 flex items-center justify-center group-hover:bg-gray-200">{{$day->format('d')}}</div>

                        </button>

                    @endforeach
                </div>






                <div class="max-h-52 overflow-y-auto">
                    @if(!$this->scheduleCheck)
                        @foreach($this->timeSlotsForDate as $slot)

                            <input type="radio" name="time" id="time_{{$slot->timestamp}}" value="{{$slot->timestamp}}" wire:model="timeSlot" class="sr-only">

                            <label for="time_{{$slot->timestamp}}" class="w-full text-left focus:outline-none px-4 py-2 flex items-center cursor-pointer border-b border-gray-100">

                                @if($slot->timestamp == $timeSlot)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                @endif

                                <span>{{$slot->format('g:i A')}}</span>    
                            </label>

                        @endforeach
                    @else
                        <div class="text-center text-gray-700 px-4 py-2">
                            Not available for new schedule
                        </div>
                    @endif

                </div>

            </div>
        </div>



        <div class="mb-6">
            @if($this->readyToCreateSchedule)


                <div class="mb-6">
                    <div class="text-gray-700 font-bold mb-2">
                        New Schedule ready
                    </div>

                    <div class="border-t border-b border-gray-300 py-2 px-2 bg-green-600 rounded-lg text-white">
                        New schedule for <span class="font-bold">{{$this->selectedService->name}} ({{$this->selectedService->duration}}min)</span>
                        with <span class="font-bold">{{$this->selectedEmployee->name}}</span>
                        
                    </div>
                </div>




                <button type="submit" class="bg-indigo-500 text-white h-11 px-4 text-center font-bold rounded-lg w-full">
                    Create Schedule
                </button>
            @endif

        </div>


        
    </form>
</div>
