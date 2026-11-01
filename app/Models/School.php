<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'npsn',
        'is_active',
    ];

    public function admin(): HasOne
    {
        return $this->hasOne(User::class, 'school_id')
                    ->where('role', 'admin_sekolah'); 
    }
    
    public function profile(): HasOne
    {
        return $this->hasOne(SchoolProfile::class);
    }
}