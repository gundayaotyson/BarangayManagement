<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seniorservices extends Model
{
    use HasFactory;

    // Optional: specify table if needed
    protected $table = 'Seniorservices';

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
        'fcapId',
        'status',
        'request_date',
        'accept_date',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
