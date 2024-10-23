<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'job',
        'name',
        'surname',
        'bio',
        'picture_path',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
    ];
}
