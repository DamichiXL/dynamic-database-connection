<?php

namespace DamichiXL\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $connection = 'sqlite';

    protected $fillable = [
        'key', 'value',
    ];

    protected $casts = [
        'value' => 'json',
    ];
}
