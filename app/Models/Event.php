<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
