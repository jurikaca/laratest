<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['item_name', 'vendor_id', 'type_id', 'serial_number', 'price', 'weight', 'color', 'release_date', 'tags', 'photo'];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }
}