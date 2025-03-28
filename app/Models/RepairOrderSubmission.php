<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairOrderSubmission extends Model
{
    //
    protected $fillable = [
        'stamp', 'repair_order', 'equipment_number', 'work_state', 'location', 'submission_date',
    ];

    protected $casts = [
        'submission_date' => 'date',
    ];
}
