<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;



    protected $fillable = [
        'name',
        'duration',
    ];


    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
