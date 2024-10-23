<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_banned',
        'ban_end_date',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function activityLogs()
    {
        return $this->hasMany(UserActivityLog::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'created_by');
    }
    public function about()
    {
        return $this->hasOne(UserAbout::class);
    }
    public function userAbout()
    {
        return $this->hasOne(UserAbout::class);
    }
    public function receivedRecommendations()
    {
        return $this->hasMany(Recommendation::class, 'for_user_id');
    }
    public function givenRecommendations()
    {
        return $this->hasMany(Recommendation::class, 'from_user_id');
    }
    public function blockedUsers()
    {
        return $this->hasMany(Block::class, 'user_id');
    }

    public function usersThatBlockedMe()
    {
        return $this->hasMany(Block::class, 'blocked_user_id');
    }
    public function isBanned()
    {
        return $this->is_banned && $this->ban_end_date > now();
    }
}
