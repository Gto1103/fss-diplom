<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['session_id'];

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
