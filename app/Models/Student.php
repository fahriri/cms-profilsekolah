<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant; // Wajib

// app/Models/Student.php

class Student extends Model
{
    use HasFactory, BelongsToTenant;

    protected $fillable = [
        'school_id',
        'name', 
        'nisn', 
        'class',
        'gender',
        'photo_url', 
        'status',
    ];

    // Tambahkan ini agar bisa memanggil $student->school->name
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}