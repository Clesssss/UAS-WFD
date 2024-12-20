<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'location',
        'event_status',
        'capacity',
        'registrants',
        'price',
        'image_url',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_id', 'id');
    }
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'event_id', 'id');
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
