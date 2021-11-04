<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\ScheduleUnavailability;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];


    public function unavailabilities()
    {
        return $this->hasMany(ScheduleUnavailability::class);
    }


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
