<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FourpsRequest extends Model
{
    use HasFactory;

    protected $table = 'fourps_requests';
    protected $fillable = [
        'resident_id',
        'lastname',
        'firstname',
        'middlename',
        'fourps_id',
        'purok_no',
        'household_no',
        'status',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
