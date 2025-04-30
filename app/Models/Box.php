<?php

namespace App\Models;

use App\Models\Cajas\Box_permit;
use App\Models\Cajas\Box_size;
use App\Models\Cajas\Box_type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $fillable = ['box_type_id','plate','box_size_id','box_permit_id'];

    public function box_size(){
        return $this->belongsTo(Box_size::class);
    }
    public function box_type(){
        return $this->belongsTo(Box_type::class);
    }
    public function box_permit(){
        return $this->belongsTo(Box_permit::class);
    }

}

