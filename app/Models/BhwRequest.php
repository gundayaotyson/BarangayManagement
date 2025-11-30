<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BhwRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'fname',
        'mname',
        'lname',
        'dob',
        'age',
        'gender',
        'purok_no',
        'sitio',
        'service_type',
        'contact_no',
        'chief_complaint',
        'status',
        'sched_date',
        'phil_no',
    ];
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
