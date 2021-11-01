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



    {{$date}}

    <div class="flex justify-between items-center px-3 border-b border-gray-200 pb-2">
        @foreach($this->calnderWeekInterval as $day)
            
            <button type="button" class="text-center group cursor-pointer focus:outline-none" wire:click="setDate({{$day->timestamp}})">

                <div class="text-xs leading-none mb-2 text-gray-700">{{$day->format('D')}}</div>

                <div class="{{$date === $day->timestamp ? 'bg-gray-300' : ''}} text-lg leading-none p-1 rounded-full w-9 h-9 flex items-center justify-center group-hover:bg-gray-200">{{$day->format('d')}}</div>

            </button>

        @endforeach
    </div>


    <div class="max-h-52 overflow-y-auto">
        <input type="radio" name="time" id="" value="" class="sr-only">

        <label for="" class="w-full text-left focus:outline-none px-4 py-2 flex items-center cursor-pointer border-b border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>9:00am</span>    
        </label>

        <input type="radio" name="time" id="" value="" class="sr-only">

        <label for="" class="w-full text-left focus:outline-none px-4 py-2 flex items-center cursor-pointer border-b border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>9:00am</span>    
        </label>

        <input type="radio" name="time" id="" value="" class="sr-only">

        <label for="" class="w-full text-left focus:outline-none px-4 py-2 flex items-center cursor-pointer border-b border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>9:00am</span>    
        </label>

        <input type="radio" name="time" id="" value="" class="sr-only">

        <label for="" class="w-full text-left focus:outline-none px-4 py-2 flex items-center cursor-pointer border-b border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>9:00am</span>    
        </label>

        <input type="radio" name="time" id="" value="" class="sr-only">

        <label for="" class="w-full text-left focus:outline-none px-4 py-2 flex items-center cursor-pointer border-b border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>9:00am</span>    
        </label>

        <input type="radio" name="time" id="" value="" class="sr-only">

        <label for="" class="w-full text-left focus:outline-none px-4 py-2 flex items-center cursor-pointer border-b border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>9:00am</span>    
        </label>

        <input type="radio" name="time" id="" value="" class="sr-only">

        <label for="" class="w-full text-left focus:outline-none px-4 py-2 flex items-center cursor-pointer border-b border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>9:00am</span>    
        </label>

        <input type="radio" name="time" id="" value="" class="sr-only">

        <label for="" class="w-full text-left focus:outline-none px-4 py-2 flex items-center cursor-pointer border-b border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>9:00am</span>    
        </label>

        <input type="radio" name="time" id="" value="" class="sr-only">

        <label for="" class="w-full text-left focus:outline-none px-4 py-2 flex items-center cursor-pointer border-b border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>9:00am</span>    
        </label>

        <div class="text-center text-gray-700 px-4 py-2">
            No available slots
        </div>

        

    </div>


    
</div>