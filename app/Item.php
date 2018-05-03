<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    protected $fillable = ['item_name', 'vendor_id', 'type_id', 'serial_number', 'price', 'weight', 'color', 'release_date', 'tags', 'photo', 'creator_id'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    static public function get_items_per_type()
    {
        $SQL = "
        SELECT
            types.`name` as type,
            COUNT(items.id) AS items_number
        FROM
            types
        JOIN items ON items.type_id = types.id
        GROUP BY
            types.id,types.`name`
        ";

        return DB::select( DB::raw($SQL) );
    }
}