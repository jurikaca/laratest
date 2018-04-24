<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['name', 'logo', 'creator_id'];
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
