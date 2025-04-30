<?php

namespace App\Models\Tractores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck_brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function model() {
        return $this->hasMany(Model::class, 'truck_model_id', 'id');
    }   
}
