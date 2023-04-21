<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;

/**
 * @property Collection<Service> $services
 * @property Collection<DentistSchedule> $schedules
 */
class Dentist extends Model
{
    use HasFactory;

    protected $with = [
        'schedules'
    ];

    protected $fillable = [
        'prc_number',
        'dental_clinic_name',
    ];

    public function profile(): MorphOne
    {
        return $this->morphOne(User::class, 'profilable');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(DentistSchedule::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
