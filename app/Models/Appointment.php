<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'dentist_id',
        'patient_id',
        'date',
        'time'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    /**
     * @param string $time
     * @return string
     */
    public function getTimeAttribute(string $time): string
    {
        return Carbon::createFromFormat('H:i:s', $time)->format('H:i');
    }

    public function services() : HasMany
    {
        return $this->hasMany(AppointmentService::class);
    }
}
