<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionComfortCategory extends Model
{
    use HasFactory;

    protected $table = 'comfort_category_position'; // имя pivot-таблицы

    protected $fillable = ['position_id', 'comfort_category_id'];

    public $timestamps = false;

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function comfortCategory()
    {
        return $this->belongsTo(ComfortCategory::class);
    }
}
