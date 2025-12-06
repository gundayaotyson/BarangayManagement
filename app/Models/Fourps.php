<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FourPs extends Model
{
    use HasFactory;

    protected $table = 'fourps';

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'purok_no',
        'household_no',
        'fourps_id',
        'status',
        'resident_id'
    ];

    /**
     * Relationship with Resident model
     */
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    /**
     * Get the full name of the beneficiary
     */
    public function getFullNameAttribute()
    {
        return $this->fname . ' ' .
               ($this->mname ? $this->mname . ' ' : '') .
               $this->lname;
    }

    /**
     * Scope for active beneficiaries
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for inactive beneficiaries
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
}
