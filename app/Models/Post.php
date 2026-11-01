<?php

// app/Models/Post.php
namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use BelongsToTenant; 
    protected $fillable = ['school_id', 'title', 'content','photo_url'];

    
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
