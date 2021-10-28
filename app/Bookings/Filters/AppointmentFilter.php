<?php

namespace App\Bookings\Filters;

use App\Bookings\FIlters\Filter;
use App\Bookings\TimeSlotGenerator;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

class AppointmentFilter implements Filter
{

	public $appointments;

	public function __construct(Collection $appointments)
	{
		$this->appointments = $appointments;
	}

	public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval)
	{
		
		$interval->addFilter(function ($slot) use ($generator) {
			foreach($this->appointments as $appo){

				$appo_start = $appo->date->setTimeFrom($appo->start_time->subMinutes($generator->service->duration));
				$appo_end = $appo->date->setTimeFrom($appo->end_time);

				if($slot->between($appo_start, $appo_end)){
					return false;
				}

			}

			return true;
		}); 
	}

}
