<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentistSchedule extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'dentist_id',
        'day',
        'time'
    ];

    public static function default(): array
    {
        return [
            'day' => 1,
            'time' => null
        ];
    }

    /**
     * @param string $time
     * @return string
     */
    public function getTimeAttribute(string $time) : string
    {
        return Carbon::createFromFormat('H:i:s', $time)->format('H:i');
    }
}
