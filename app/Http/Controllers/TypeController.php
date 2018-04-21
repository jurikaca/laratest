<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $types = Type::all();
        return view('types.index', compact('types'));
    }
}
