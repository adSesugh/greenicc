<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'picture',
        'fb_url',
        'twitter_url',
        'linkedin_url',
        'insta_url',
        'published',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
