<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKService extends Model
{
    use HasFactory;

    protected $table = 'sk_services';

    protected $fillable = [
        'resident_id',
        'firstname',
        'lastname',
        'school',
        'school_year',
        'type_of_service',
        'status',
        'attachment',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
