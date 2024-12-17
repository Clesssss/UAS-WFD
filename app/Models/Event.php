<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Event extends Model
{
    protected $table = 'events';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function registration()
    {
        return $this->hasMany(Registration::class, 'registration_id', 'registration_id');
    }

    public function getStatusAttribute()
    {
        $now = Carbon::now();

        if ($now->lt($this->start_time)) {
            return 'upcoming';
        } elseif ($now->between($this->start_time, $this->end_time)) {
            return 'ongoing';
        } else {
            return 'finished';
        }
    }
}
