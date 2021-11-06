<div class="bg-gray-200 max-w-sm mx-auto m-6 p-5 rounded-lg">


    <div class="mb-6">
        
        @if($appointments->count())

            <p class="mb-5 text-center text-lg text-bold text-black">List of Appointments</p>

            @foreach($appointments as $appo)
                <a href="{{route('bookings.show', $appo) . '?token=' . $appo->token}}">
                    <div class="px-3 py-4 mb-3 bg-gray-300 rounded-lg cursor-pointer flex justify-between hover:bg-gray-500 hover:text-white">
                        <p>{{$appo->client_name}} <span class="italic text-sm">({{$appo->client_email}})</span></p>
                        <p>{{$appo->date->format('d/M/Y')}}</p>
                    </div>
                </a>
            @endforeach
        @else

            <div class="text-center text-gray-700 text-lg px-4 py-2">
                There are no appointments for now
            </div>

        @endif


        <div class="mt-8">
            <a class="hover:text-blue-500 text-sm" href="{{route('bookings.create')}}">book an appointment</a>
        </div>

    </div>



</div>
