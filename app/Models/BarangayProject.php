<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'purok',
        'sitio',
        'category',
        'description',
        'start_date',
        'target_completion_date',
        'status',
        'completion_percentage',
        'total_budget',
        'funds_utilized',
        'funding_source',
        'project_lead',
        'contractor',
        'challenges',
        'feedback',
        'maintenance_plan',
    ];

    // Automatically set sitio based on purok
    public static function getSitio($purok)
    {
        $mapping = [
            'Purok 1' => 'Sitio Leksab',
            'Purok 2' => 'Sitio Taew',
            'Purok 3' => 'Pidlaoan St',
        ];
        return $mapping[$purok] ?? 'N/A';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            $project->sitio = self::getSitio($project->purok);
        });

        static::updating(function ($project) {
            $project->sitio = self::getSitio($project->purok);
        });
    }
}
