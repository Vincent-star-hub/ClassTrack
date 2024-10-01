<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionTerm extends Model
{
    use HasFactory;

    protected $fillable = ['session_name', 'term_name', 'status']; // Update with your actual column names
}
