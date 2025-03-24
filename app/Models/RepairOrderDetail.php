<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairOrderDetail extends Model
{
    //
    protected $fillable = [
        'stamp', 'repair_order', 'total_time', 'technician_1_id', 'hours_tec_1',
        'technician_2_id', 'hours_tec_2', 'technician_3_id', 'hours_tec_3',
        'technician_4_id', 'hours_tec_4', 'technician_5_id', 'hours_tec_5',
        'technician_6_id', 'hours_tec_6', 'technician_7_id', 'hours_tec_7',
        'technician_8_id', 'hours_tec_8', 'technician_9_id', 'hours_tec_9',
        'technician_10_id', 'hours_tec_10', 'work_state', 'location',
    ];

    public function technician1() { return $this->belongsTo(Technician::class, 'technician_1_id'); }
    public function technician2() { return $this->belongsTo(Technician::class, 'technician_2_id'); }
    public function technician3() { return $this->belongsTo(Technician::class, 'technician_3_id'); }
    public function technician4() { return $this->belongsTo(Technician::class, 'technician_4_id'); }
    public function technician5() { return $this->belongsTo(Technician::class, 'technician_5_id'); }
    public function technician6() { return $this->belongsTo(Technician::class, 'technician_6_id'); }
    public function technician7() { return $this->belongsTo(Technician::class, 'technician_7_id'); }
    public function technician8() { return $this->belongsTo(Technician::class, 'technician_8_id'); }
    public function technician9() { return $this->belongsTo(Technician::class, 'technician_9_id'); }
    public function technician10() { return $this->belongsTo(Technician::class, 'technician_10_id'); }
}
