<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportsEquipment extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','url'];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

}
