<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;
    public $fillable = [
        'title', 'description', 'duration', 'country', 'poster'
    ];
    public $timestamps = false;

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class, 'movie_id');
        // return $this->hasMany(Session::class)->orderBy('start');
    }
}
