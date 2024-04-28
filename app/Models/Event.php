<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $fillable = [
        'name',
        'date',
        'location',
        'available_slots',
        'description'
    ];

    public function registrations()
    {
        return $this->hasMany(\App\Models\Registration::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'registrations');
    }
}
