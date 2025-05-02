<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicYear extends Model
{
    use SoftDeletes;

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'is_open_for_admission' => 'boolean',
    ];

  
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeAdmissionOpen($query)
    {
        return $query->where('is_open_for_admission', true);
    }

    public function scopeCurrent($query)
    {
        return $query->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now());
    }
}