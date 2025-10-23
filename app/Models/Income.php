<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'date_from',
        'date_to'
    ];

    protected $casts = [
        'data' => 'array',
    ];
}