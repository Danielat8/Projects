<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSpeaker extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'type',
        'image',
        'linkedin',
        'event_id',
        'conference_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function conference()
    {
        return $this->belongsTo(AnnualConference::class, 'conference_id');
    }
}
