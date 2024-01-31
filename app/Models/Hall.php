<?php

namespace App\Models;

use App\Models\Session;
use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hall extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'seats' => 'array'
    ];
    protected $fillable = [
        'name',
        'rows',
        'cols',
        'seats',
        'price',
        'vip_price',
        'is_open',
    ];

    public function sessions() : HasMany
    {
        return $this->hasMany(Session::class, 'hall_id');
    }

    public function seats() : HasMany
    {
        return $this->hasMany(Seat::class, 'hall_id');
    }
}
