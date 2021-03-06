<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFeatures extends Model
{
    use HasFactory;
    protected $fillable = [
        'feature_id',
        'value',
        'property_id',
    ];
}
