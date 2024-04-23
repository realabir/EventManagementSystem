<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veranstaltungen extends Model
{
    use HasFactory;
    protected $table = 'veranstaltungens';
    protected $fillable = [
        'name',
        'date',
        'location',
        'available_slots',
        'description'
    ];
}
