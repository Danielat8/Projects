<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualConference extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'date',
        'location',
        'title',
        'theme',
        'description',
        'objective',
        'agenda',
        'status',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
