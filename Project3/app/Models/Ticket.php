<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'conference_id',
        'ticket_type',
        'price',
        'quantity',
        'available',
        'ticket_name',
        'ticket_date',
        'place',
    ];
    public function conference()
    {
        return $this->belongsTo(AnnualConference::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function boughtTickets()
    {
        return $this->hasMany(BoughtTicket::class);
    }
}
