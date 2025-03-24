<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairOrderInvoice extends Model
{
    //
    protected $fillable = [
        'stamp', 'repair_order', 'invoice_date', 'invoiced_hours', 'qty_oxygen',
        'qty_acetylene', 'qty_propane', 'work_state', 'location', 'accounting_status',
    ];

    protected $casts = [
        'invoice_date' => 'date',
    ];
}
