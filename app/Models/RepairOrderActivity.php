<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairOrderActivity extends Model
{
    //
    protected $fillable = [
        'stamp', 'repair_order', 'equipment_number', 'technician_id', 'execution_date_1',
        'invoiced_hours_1', 'execution_date_2', 'invoiced_hours_2', 'activity_description', 'client',
    ];

    protected $casts = [
        'execution_date_1' => 'date',
        'execution_date_2' => 'date',
    ];

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
