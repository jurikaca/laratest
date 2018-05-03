<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name', 'creator_id'];
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
