<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayOfficial extends Model
{
    use HasFactory;

    protected $fillable = ['fname', 'mname', 'lname', 'position', 'term_start', 'term_end', 'status', 'resident_id'];

    public function resident()
{
    return $this->belongsTo(Resident::class);
}

}
