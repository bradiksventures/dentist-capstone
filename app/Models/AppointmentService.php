<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppointmentService extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'appointment_id',
        'service_id',
        'price'
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
