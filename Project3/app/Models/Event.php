<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'date',
        'theme',
        'objective',
        'location',
        'picture_path',
    ];

    public function annualConference()
    {
        return $this->belongsTo(AnnualConference::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function speakers()
    {
        return $this->hasMany(EventSpeaker::class);
    }
}
