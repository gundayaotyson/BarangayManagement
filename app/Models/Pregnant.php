<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregnant extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'Fname',
        'mname',
        'lname',
        'birthday',
        'household_no',
        'purok_no',
        'LMP_date',
        'EMC_date',
        'sitio',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
