<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Seat extends Model
{
    use HasFactory;

    protected $casts = [
        'seance_seats' => 'array',
        'selected_seats' => 'array',

    ];
    protected $fillable = [
        'session_id',
        'seance_seats',
        'selected_seats',
    ];
    public $timestamps = false;

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    public function tickets(): BelongsToMany
    {
        return $this->belongsToMany(Ticket::class);
    }
}
