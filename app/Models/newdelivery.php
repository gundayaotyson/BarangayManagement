<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newdelivery extends Model
{
    use HasFactory;

    // protected $table = 'newdelivery'; // IMPORTANT!

    protected $fillable = [
        'resident_id',
        'pregnants_id',
        'p_fname',
        'p_mname',
        'p_lname',
        'age',
        'birthday',
        'purok_no',
        'sitio',
        'household_no',
        'birthplace', // dapat palitan sa data base
        'typeof_birth',
        'c_fname',
        'c_mname',
        'c_lname',
        'c_birthday',
        'time',
        'weight',
        'height',
        'gender',

    ];
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
    public function pregnant()
    {
        return $this->belongsTo(Pregnant::class, 'pregnants_id');
    }
}
