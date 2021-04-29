<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function client() 
    {
        return $this->HasMany(Client::class);
    }

    public function news() 
    {
        return $this->HasMany(News::class);
    }

    public function project() 
    {
        return $this->HasMany(Project::class);
    }

    public function service() 
    {
        return $this->HasMany(Service::class);
    }

    public function slide() 
    {
        return $this->HasMany(Slide::class);
    }

    public function team() 
    {
        return $this->HasMany(Team::class);
    }

    public function whychooseus() 
    {
        return $this->HasMany(WhyChooseUs::class);
    }

    public function testimonial() 
    {
        return $this->HasMany(Testimonial::class);
    }

    public function gallery() 
    {
        return $this->HasMany(Gallery::class);
    }
}
