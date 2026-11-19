<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
    'tracking_code',
    'title',
    'category',
    'location',
    'latitude',
    'longitude',
    'description',
    'evidence_path',
    'status',
    'admin_remarks',
    'verified_by',
];


public function verifier()
{
    return $this->belongsTo(User::class, 'verified_by');
}
    public function assignedStaff()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function blotterArchive()
    {
        return $this->hasOne(BlotterArchive::class);
    }
}