<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    use HasFactory;
    public function property()
    {
        return $this->belongsToMany(Property::class, 'property_features', 'feature_id', 'property_id');
    }
}
