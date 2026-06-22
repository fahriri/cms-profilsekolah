<?php

// app/Models/Post.php
namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use BelongsToTenant; // <<< Terapkan Trait di sini
    protected $fillable = ['school_id', 'title', 'content','photo_url'];

    // app/Models/Student.php
public function school()
{
    return $this->belongsTo(School::class);
}
}
