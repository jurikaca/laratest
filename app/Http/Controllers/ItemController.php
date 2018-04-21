<?php

namespace App\Http\Controllers;

use App\Type;
use App\Vendor;
use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $items = Item::pluck('name', 'id');
        return view('items.create', compact('items'));
    }

    public function store(Request $request)
{
    $rules = [
//        'title' => ['required', 'min:20', 'max:200', 'unique:blogs'],
//        'body' => ['required', 'min:200'],
//        'photo_id' => ['mimes:jpeg,jpg,png', 'max:5000'],
//        'category_id' => ['required'],
//        'meta_desc' => ['required', 'min:10', 'max:300'],
    ];

    $message = [
//        'photo_id.mimes' => 'Your image must be jpeg, jpg or png',
//        'category_id.required' => 'The category field is required',
//        'photo_id.max' => 'Your image should not be larger than 1mb',
    ];

//    $this->validate($request, $rules, $message);

    $input = $request->all();

    //dd($input);

//    if ($file = $request->file('photo_id')) {
//        $name = Carbon::now(). '.' .$file->getClientOriginalName();
//        $file->move('images', $name);
//        $photo = Photo::create(['photo' => $name, 'title' => $name]);
//        $input['photo_id'] = $photo->id;
//    }

    $item = Item::create($input);
//    if ($categoryIds = $request->category_id) {
//        $blog->category()->sync($categoryIds);
//    }

//    notify()->flash('<h2>You have successfully created a Blog</h2>', 'success');

    return redirect('item');
}

    public function show($id)
    {
        $item = Item::whereSlug($id)->first();
        return view('items.show', compact('item'));
    }

    public function edit($id)
    {
        $types = Type::pluck('name', 'id');
        $vendors = Vendor::pluck('name', 'id');
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item', 'types', 'vendors', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
//            'title' => ['required', 'min:20', 'max:200'],
//            'body' => ['required', 'min:200'],
//            'photo_id' => ['mimes:jpeg,jpg,png', 'max:5000'],
        ];

        $message = [
//            'photo_id.mimes' => 'Your image must be jpeg, jpg or png',
//            'category_id.required' => 'The category field is required',
//            'photo_id.max' => 'Your image should not be larger than 1mb',
        ];

        $this->validate($request, $rules, $message);

        $input = $request->all();
        $item = Item::findOrFail($id);

//        if ($file = $request->file('photo_id')) {
//
//            if ($item->photo) {
//                unlink('images/' . $item->photo->photo);
//                $item->photo()->delete('photo');
//            }
//
//            $name = Carbon::now(). '.' .$file->getClientOriginalName();
//            $file->move('images', $name);
//            $photo = Photo::create(['photo' => $name, 'title' => $name]);
//            $input['photo_id'] = $photo->id;
//        }

        $item->update($input);

//        notify()->flash('<h2>You have successfully edited a Blog</h2>', 'success');

        return redirect('item')->withInput();
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        if ($item->photo) {
            unlink('images/' . $item->photo);
        }
        return redirect('item');
    }
}
