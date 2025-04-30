<?php

namespace App\Models;

use App\Models\Tractores\Truck_model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tractor extends Model
{
    use HasFactory;
    protected $fillable = ['serialNumber', 'truck_model_id', 'plate', 'mileage', 'user_id'];

    public function truck_model(){
        return $this->belongsTo(Truck_model::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
