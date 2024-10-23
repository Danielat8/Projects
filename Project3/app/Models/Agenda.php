<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'time',
        'description',
        'conference_id',
        'title',
    ];

    public function descriptions()
    {
        return $this->hasMany(Description::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function conference()
    {
        return $this->belongsTo(AnnualConference::class);
    }
}
