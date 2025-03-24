<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
class RepairOrder extends Model
{
    // use HasFactory;
    //
    protected $fillable = [
        'stamp',
        'repair_order',
        'machine_number',
        'month_entry',
        'year_entry',
        'date_entry',
        'breakdown_description',
        'mantainance_type',
        'applicant',
        'work_state',
        'location',
        'cliente',
    ];
}
