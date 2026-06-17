<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'sports_equipment_id'];

    public function sportsEquipment()
    {
        return $this->belongsTo(SportsEquipment::class);
    }

}
