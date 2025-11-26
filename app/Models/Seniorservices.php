<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seniorservices extends Model
{
    use HasFactory;

    // Specify table if it doesn't follow Laravel naming convention
    protected $table = 'senior_services';

    protected $fillable = [
        'resident_id',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'age',
        'gender',
        'house_no',
        'purok',
        'sitio',
        'oscaId',
        'status',
        'fcapId',
        'request_date',
        'accept_date'
    ];


    protected $casts = [
        'request_date' => 'date',
        'accept_date' => 'date',
    ];

    // Optional: relationship with resident
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
