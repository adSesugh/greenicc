<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name',
        'logo',
        'breadcrumb',
        'email',
        'phone',
        'fb_url',
        'twitter_url',
        'insta_url',
        'google_url',
        'linkedin_url',
        'about_us',
        'address',
        'whyus_background'
    ];
}
