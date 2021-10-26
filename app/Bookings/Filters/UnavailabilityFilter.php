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
			dump($slot);
			foreach($this->unavailabilities as $not_av){

			}

			return true;
		});
	}

}
