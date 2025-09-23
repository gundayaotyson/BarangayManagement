<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayCase extends Model
{
    use HasFactory;

    protected $fillable = ['case_title', 'description', 'date_filed'];
}
