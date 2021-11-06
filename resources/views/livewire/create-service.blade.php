<div class="bg-gray-200 max-w-sm mx-auto m-6 p-5 rounded-lg">
    <p class="text-center text-gray-700 text-xl font-bold mb-2">Add new service</p>

    <form wire:submit.prevent="createService">

        <div class="mb-6">
            <label for="service" class="inline-block text-gray-700 font-bold mb-2">Service name</label>
            <input type="text" id="service" class="bg-white h-10 w-full border-none rounded-lg" wire:model="state.service" autocomplete="off">

            @error('state.service')
                <div class="font-semibold text-red-500 text-sm mt-2">
                    {{$message}}
                </div>
            @enderror
        </div>


        <div class="mb-6">
            <label for="duration" class="inline-block text-gray-700 font-bold mb-2">Service duration</label>
            <input type="number" min="30" max="180" step="15" id="duration" class="bg-white h-10 w-full border-none rounded-lg" wire:model="state.duration">

            @error('state.duration')
                <div class="font-semibold text-red-500 text-sm mt-2">
                    {{$message}}
                </div>
            @enderror
        </div>

        
        <button type="submit" class="bg-indigo-500 text-white h-11 px-4 text-center font-bold rounded-lg w-full">
            Add service
        </button>
        
    </form>

    <div class="mt-8">
        <a class="hover:text-blue-500 text-sm" href="{{route('bookings.create')}}">book an appointment</a>
    </div>

</div>