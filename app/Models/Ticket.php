<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'title_movie',
        'selected_seats',
        'name_hall',
        'total_price',
    ];

    public $timestamps = false;

    public function session(): belongsTo
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function seats(): BelongsToMany
    {
        return $this->belongsToMany(Seat::class);
    }
}
