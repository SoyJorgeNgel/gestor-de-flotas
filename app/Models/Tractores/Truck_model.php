<?php

namespace App\Models\Tractores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck_model extends Model
{
    use HasFactory;
    protected $fillable = ['model', 'year', 'truck_brand_id'];

    public function truck_brand(){
        return $this->belongsTo(Truck_brand::class);
    }

}
