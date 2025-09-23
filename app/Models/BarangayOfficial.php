<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayOfficial extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'position', 'term_start', 'term_end', 'status', 'resident_id'];

    public function resident()
{
    return $this->belongsTo(Resident::class);
}

public function autocompleteResidents(Request $request)
{
    $search = $request->get('query');

    $residents = Resident::where('fullname', 'LIKE', "%{$search}%")
        ->limit(10)
        ->get(['fullname']);

    return response()->json($residents);
}

}
