<?php

namespace App\Bookings\Filters;

use App\Bookings\FIlters\Filter;
use App\Bookings\TimeSlotGenerator;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

class UnavailabilityFilter implements Filter
{

	public function __construct(Collection $unavailabilities)
	{
		$this->unavailabilities = $unavailabilities;
	}

	public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval)
	{
		
		$interval->addFilter(function ($slot) use ($generator) {
			foreach($this->unavailabilities as $not_av){

				$not_av_start = $not_av->schedule->date->setTimeFrom($not_av->start_time->subMinutes($generator->service->duration - $generator::INCREMENT));
				$not_av_end = $not_av->schedule->date->setTimeFrom($not_av->end_time->subMinutes($generator::INCREMENT));

				if($slot->between($not_av_start, $not_av_end)){
					return false;
				}
			}

			return true;
		}); 
	}

}
