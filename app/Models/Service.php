<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $label
 * @property float $price
 */
class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'dentist_id',
        'price',
        'label'
    ];
}
