<?php

namespace App\Models;

use App\Models\Schedule;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;


    public function services()
    {
        return $this->belongsToMany(Service::class);
    }


    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
