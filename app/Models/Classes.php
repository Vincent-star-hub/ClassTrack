<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Define the relationship with sections
    public function sections()
    {
        return $this->hasMany(Section::class, 'class_id');
    }

    // Define the relationship with students
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    // Define the relationship with attendances
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'class_id');
    }
}
