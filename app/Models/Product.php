<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by', 'species_id', 'grade_id', 'drying_method_id', 'treatment_id', 'thickness', 'width', 'length',
    ];
}
