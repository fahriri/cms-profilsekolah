<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolProfile extends Model
{
    use HasFactory;
    protected $table = 'school_profiles';
    
    protected $fillable = [
        'school_id',
        'logo_url',
        'vision',
        'mission',
        'description',
        'address',
        'contact_phone',
        'contact_email',
        'principal_name',
        'principal_photo_url',
        'principal_welcome_message',
    ];
    
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}