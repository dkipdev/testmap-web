<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkerCategory extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function markers() {
        return $this->hasMany(Marker::class);
    }
}
