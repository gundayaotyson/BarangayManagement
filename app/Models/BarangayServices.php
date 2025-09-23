<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayServices extends Model
{
    use HasFactory;

    // Define the table name (optional if the table is following the Laravel naming convention)
    protected $table = 'barangay_services';

    // Allow these fields to be mass assignable
    protected $fillable = [
        'name',         // Name of the Barangay service
        'description',  // Description of the service
    ];

    // If you have relationships, define them here (for example, a relationship to the ClearanceReq model)
    public function clearanceRequests()
    {
        return $this->hasMany(ClearanceReq::class, 'service_id');
    }
}
