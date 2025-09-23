<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Clearancereq extends Model
{
    use HasFactory;

    protected $table = 'clearancereq';

    protected $fillable = [
        'resident_id',
        'fullname',
        'address',
        'dateofbirth',
        'placeofbirth',
        'civil_status',
        'gender',
        'purpose',
        'pickup_date',
        'tracking_code',
        'status',
        'requested_date', // ✅ Added requested_date
        'released_date',  // ✅ Keep released_date
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

    // Mutator: Update `released_date` when status is changed to "released"
    public function setStatusAttribute($value)
{
    $this->attributes['status'] = $value;

    if ($value === 'released') {
        $this->attributes['released_date'] = now(); // ✅ Set released_date kapag released
    } else {
        $this->attributes['released_date'] = null; // ✅ Reset released_date kung hindi released
    }

    $this->save(); // ✅ Ensure that changes are saved to the database
}


public function resident()
{
    return $this->belongsTo(Resident::class, 'resident_id');
}

}
