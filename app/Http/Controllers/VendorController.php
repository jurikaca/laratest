<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $vendors = Vendor::all();
        return view('vendors.index', compact('vendors'));
    }
}
