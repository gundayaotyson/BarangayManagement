<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Clearancereq extends Model
{
    use HasFactory;

    protected $table = 'clearancereq';

    protected $casts = [
    'released_date' => 'datetime',
];

    protected $fillable = [
        'resident_id',
        'Fname',
        'mname',
        'lname',
        'address',
        'dateofbirth',
        'placeofbirth',
        'civil_status',
        'gender',
        'purpose',
        'service_type',
        'pickup_date',
        'tracking_code',
        'status',
        'requested_date',
        'released_date',
        'business_name',
        'business_type',
        'business_address',
        'res_started_living',
        'cert_use_date',
    ];

    // Automatically generate tracking_code & set requested_date when creating a new request
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($clearance) {
            $clearance->tracking_code = strtoupper(Str::random(10)); // Generates a unique 10-character tracking code
            $clearance->requested_date = now(); // ✅ Auto-set requested_date
        });
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }
}
