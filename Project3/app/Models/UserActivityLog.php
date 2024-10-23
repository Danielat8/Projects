<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    protected $table = 'user_activity_log';
    protected $fillable = [
        'user_id',
        'notification_target_preference',
        'notification_topic_preference',
        'job',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
