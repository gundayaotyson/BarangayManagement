<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Senior extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'lastname',
        'firstname',
        'middlename',
        'birthday',
        'osca_id',
        'fcap_id',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
