<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitMeasure extends Model
{
    use HasFactory;

    protected $primaryKey = 'unit_id';

    public function products(){
        return $this->hasMany(Product::class);
    }

    protected $fillable = [
        'abbreviation',
        'description'
    ];
}