<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKProject extends Model
{
    use HasFactory;

    protected $table = 'sk_projects';

    protected $fillable = [
        'project_name',
        'purok',
        'category',
        'start_date',
        'target_date',
        'budget',
        'status',
        'progress',
    ];
}
