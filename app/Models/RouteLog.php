<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteLog extends Model
{
    use HasFactory;
    protected $fillable = ['travel_id', 'numberShipment', 'destination_id'];
    public function destination(){
        return $this->belongsTo(Destination::class);
    }
}
