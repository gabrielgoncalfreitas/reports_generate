<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportsProfiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'report_id',
        'profile_id'
    ];
}
