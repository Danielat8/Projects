<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAbout extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname',
        'bio',
        'title',
        'phone',
        'city',
        'country',
        'cv_upload',
        'photo_upload',
        'user_id',

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
