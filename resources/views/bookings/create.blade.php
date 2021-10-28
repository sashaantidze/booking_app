<div style="font-weight: bold;">Service: {{$service->name}} ({{$service->duration}}m)</div>

<br>

@foreach($slots as $slot)
	{{ $slot }} <br>
@endforeach