<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name', 'class_id', 'status'];

    // Define the relationship with classes
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    // Define the relationship with students
    public function students()
    {
        return $this->hasMany(Student::class, 'section_id');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
