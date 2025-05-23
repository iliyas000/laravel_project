<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $table = 'positions';

    protected $fillable = ['title'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function comfortCategories()
    {
        return $this->belongsToMany(ComfortCategory::class);
    }
}
