<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Dentist extends Model
{
    use HasFactory;

    public function profile() : MorphOne
    {
        return $this->morphOne(User::class, 'profilable');
    }
}
