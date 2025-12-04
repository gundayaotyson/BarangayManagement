<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Fourps extends Model
    {
        use HasFactory;

        protected $fillable = [
            'resident_id',
            'fname',
            'mname',
            'lname',
            'purok_no',
            'house_no',
            'fourps_id',
            'status',
        ];

        public function resident()
        {
            return $this->belongsTo(Resident::class);
        }
    }
