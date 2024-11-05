<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $primaryKey = 'room_id';

    public $timestamps = false;

    protected $fillable = [
        'room_number',
        'room_type',
        'description',
        'capacity',
        'price_per_night',
        'availability_status',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'availability_status' => 'boolean',
    ];
}
