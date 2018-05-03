<?php

namespace App\Http\Controllers;

use App\Type;
use App\User;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Item;
use Auth;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('regular', ['only' => ['create', 'store']]);
    }

    public function index()
    {
        if(Auth::user()->role == User::ADMIN){
            $items = Item::all();
        }else{
            $items = Item::where([
                'creator_id'    =>  Auth::user()->id
            ])->get();
        }
        return view('items.index', compact('items'));
    }

    public function create()
    {
        if(Auth::user()->role == User::ADMIN){
            $vendors = Vendor::all();
        }else{
            $vendors = Vendor::where([
                'creator_id'    =>  Auth::user()->id
            ])->get();
        }
        $types = Type::all();
        return view('items.create', compact('vendors'), compact('types'));
    }

    public function store(Request $request)
    {
        $rules = [
            'item_name' => ['required', 'min:3', 'max:200', 'unique:items'],
            'vendor_id' => ['required'],
            'type_id' => ['required'],
            'serial_number' => ['required'],
            'price' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'release_date' => ['required','after:' . date('Y-m-d',strtotime(date('Y-m-d')." - 1 days")) . '','date_format:Y-m-d'],
            'file' => ['required','mimes:jpeg,jpg,png', 'max:1024'],
        ];

        $message = [
            'vendor_id.required' => 'The vendor field is required',
            'type_id.required' => 'The type field is required',
            'file.max' => 'Your image should not be larger than 1mb',
            'file.mimes' => 'Your image must be jpeg, jpg or png',
        ];

        $this->validate($request, $rules, $message);

        $input = $request->all();

        if ($file = $request->file('file')) {
            $name = uniqid(). '_' .$file->getClientOriginalName();
            $file->move('images', $name);
            $input['photo'] = $name;
        }

        $input['creator_id'] = Auth::user()->id;

        $item = Item::create($input);

        notify()->flash('You have successfully created an item', 'success');

        return redirect('items')->withInput();
    }

    public function edit($id)
    {
        if(Auth::user()->role == User::ADMIN){
            $vendors = Vendor::all();
        }else{
            $vendors = Vendor::where([
                'creator_id'    =>  Auth::user()->id
            ])->get();
        }
        $types = Type::all();
        $item = Item::findOrFail($id);
        if(Auth::user()->role != User::ADMIN && $item->creator_id != Auth::user()->id){
            notify()->flash('You dont have permission to edit this item', 'warning');
            return redirect('items');
        }
        return view('items.edit', compact('item', 'types', 'vendors', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'item_name' => ['required', 'min:3', 'max:200'],
            'vendor_id' => ['required'],
            'type_id' => ['required'],
            'serial_number' => ['required'],
            'price' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'release_date' => ['required'],
            'file' => ['mimes:jpeg,jpg,png', 'max:1024'],
        ];

        $message = [
            'vendor_id.required' => 'The vendor field is required',
            'type_id.required' => 'The type field is required',
            'file.max' => 'Your image should not be larger than 1mb',
            'file.mimes' => 'Your image must be jpeg, jpg or png',
        ];

        $this->validate($request, $rules, $message);

        $input = $request->all();
        $item = Item::findOrFail($id);
        if(Auth::user()->role != User::ADMIN && $item->creator_id != Auth::user()->id){
            notify()->flash('You dont have permission to edit this item', 'warning');
            return redirect('items');
        }

        if ($file = $request->file('file')) {

            if ($item->photo) {
                unlink('images/' . $item->photo);
            }

            $name = uniqid(). '_' .$file->getClientOriginalName();
            $file->move('images', $name);
            $input['photo'] = $name;
        }

        $item->update($input);

        notify()->flash('You have successfully edited an item', 'success');

        return redirect('items')->withInput();
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        if(Auth::user()->role != User::ADMIN && $item->creator_id != Auth::user()->id){
            notify()->flash('You dont have permission to delete this item', 'warning');
            return redirect('items');
        }
        if ($item->photo) {
            unlink('images/' . $item->photo);
        }
        $item->delete();

        notify()->flash('You have successfully deleted an item', 'success');

        return redirect('items');
    }
}
