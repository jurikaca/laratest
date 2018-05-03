<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('dashboard.index',[
            'num_items'         =>  Item::all()->count(),
            'average_price'     =>  round(Item::avg('price'),2),
            'chart_data'        =>  Item::get_items_per_type(),
            'items'             =>  Item::orderBy('id', 'desc')->take(5)->get()
        ]);
    }
}
