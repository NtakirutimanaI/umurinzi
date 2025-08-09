<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'brand', 'model', 'serial_number', 'imei_1', 'imei_2',
        'imei_3_or_mac_or_plate', 'type', 'os', 'status',
        'purchase_date', 'warranty_expiry', 'location',
        'last_seen_at', 'notes', 'client_id', 'assigned_technician_id'
    ];

    // Each device belongs to a client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Each device may be assigned to a technician
    public function technician()
    {
        return $this->belongsTo(Technician::class, 'assigned_technician_id');
    }
}
