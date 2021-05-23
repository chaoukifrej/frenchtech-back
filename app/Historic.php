<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    protected $fillable = [
        'total_actors', 'total_funds', 'total_jobs_available', 'total_women_number', 'total_employees_number', 'total_revenues'
    ];
}
