<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait; // Import CrudTrait
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Student extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasFactory;
    use CrudTrait; // Use CrudTrait for Backpack integration


    protected $fillable = [
        'full_name',
        'birthday',
        'gender',
        'email',
        'password',
        'address',
        'phonenumber',
        'university',
        'degree',
        'year',
        'major',
        'experience_name',
        'position',
        'duration',
    ];

    // Ensure the password is always hashed
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function favorites()
    {
        return $this->belongsToMany(Blog::class, 'favorites', 'student_id', 'blog_id');
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);  // One student has many experiences
    }

}
