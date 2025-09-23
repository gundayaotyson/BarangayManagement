<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'Fname', 'mname', 'lname', 'gender', 'birthday', 'birthplace',
        'age', 'civil_status', 'Citizenship', 'contact_number', 'occupation',
        'household_no', 'purok_no', 'sitio','religion', 'image', 'email'
    ];


    // Automatically calculate age based on birthday
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthday)->age;
    }

    public function clearancereqs()
{
    return $this->hasMany(Clearancereq::class,'resident_id');
}
public function official()
{
    return $this->hasOne(BarangayOfficial::class);
}


}
