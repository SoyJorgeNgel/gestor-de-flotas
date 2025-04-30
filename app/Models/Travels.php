<?php

namespace App\Models;

use App\Models\Cajas\Box_cargo;
use App\Models\Cajas\Box_type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travels extends Model
{
    use HasFactory;
    protected $fillable = [
        'departure_id',
        'invoiceDate',
        'departureDate',
        'departureTime',
        'returnDate',
        'returnTime',
        'user_id',
        'box_cargo_id',
        'box_type_id',
        'box_id',
        'tractor_id',
        'quantity',
        'freightCost',
        'boothCost',
        'expense',
        'kmTraveled',
        'status_id'
    ];
    public function departure(){
        return $this->belongsTo(Departure::class);
    }
    public function tractor(){
        return $this->belongsTo(Tractor::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function box(){
        return $this->belongsTo(Box::class);
    }
    public function box_cargo(){
        return $this->belongsTo(Box_cargo::class);
    }
    public function box_type(){
        return $this->belongsTo(Box_type::class);
    }
    public function status(){
        return $this->belongsTo(Status::class);
    }
}
