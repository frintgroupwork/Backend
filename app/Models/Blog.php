<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait; // Import CrudTrait


class Blog extends Model
{
    use HasFactory;
    use CrudTrait; // Use CrudTrait for Backpack integration


    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'image',
        'date',
        'blog_type_id',
        'source', // Add the source field here

    ];

    protected $appends = ['favorited_by_current_user'];


    public function blogType()
    {
        return $this->belongsTo(BlogType::class, 'blog_type_id');
    }


    public function favoritedBy()
    {
        return $this->belongsToMany(Student::class, 'favorites', 'blog_id', 'student_id');
    }

    public function getFavoritedByCurrentUserAttribute()
    {
        $currentUser = auth('sanctum')->user();
        if (!$currentUser) {
            return false;
        }

        return $this->favoritedBy()->where('student_id', $currentUser->id)->exists();
    }


}
