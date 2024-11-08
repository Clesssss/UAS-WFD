<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registrations';

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }
    public function payment()
    {
        return $this->hasMany(Payment::class, 'payment_id', 'payment_id');
    }
}
