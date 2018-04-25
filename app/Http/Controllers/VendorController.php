<?php

namespace App\Http\Controllers;

use App\User;
use App\Vendor;
use Illuminate\Http\Request;
use Auth;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('regular', ['only' => ['create', 'store']]);
    }

    public function index(){
        if(Auth::user()->role == User::ADMIN){
            $vendors = Vendor::all();
        }else{
            $vendors = Vendor::where([
                'creator_id'    =>  Auth::user()->id
            ])->get();
        }
        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'min:1', 'max:200', 'unique:vendors'],
            'file' => ['required','mimes:jpeg,jpg,png', 'max:1024'],
        ];

        $message = [
            'file.max' => 'Your image should not be larger than 1mb',
            'file.mimes' => 'Your image must be jpeg, jpg or png',
        ];

        $this->validate($request, $rules, $message);

        $input = $request->all();
        $input['creator_id'] = Auth::user()->id;

        if ($file = $request->file('file')) {
            $name = uniqid(). '_' .$file->getClientOriginalName();
            $file->move('vendors_img', $name);
            $input['logo'] = $name;
        }

        $vendor = Vendor::create($input);

        notify()->flash('You have successfully created a vendor', 'success');

        return redirect('vendors')->withInput();
    }

    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => ['required', 'min:1', 'max:200', 'unique:vendors,name,'.$id],
            'file' => ['mimes:jpeg,jpg,png', 'max:1024'],
        ];

        $message = [
            'file.max' => 'Your image should not be larger than 1mb',
            'file.mimes' => 'Your image must be jpeg, jpg or png',
        ];

        $this->validate($request, $rules, $message);

        $input = $request->all();
        $vendor = Vendor::findOrFail($id);

        if ($file = $request->file('file')) {

            if ($vendor->logo) {
                unlink('vendors_img/' . $vendor->photo);
            }

            $name = uniqid(). '_' .$file->getClientOriginalName();
            $file->move('vendors_img', $name);
            $input['logo'] = $name;
        }

        $vendor->update($input);

        notify()->flash('You have successfully edited a vendor', 'success');

        return redirect('vendors')->withInput();
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        if ($vendor->logo) {
            unlink('vendors_img/' . $vendor->logo);
        }
        $vendor->delete();
        notify()->flash('You have successfully deleted a vendor', 'success');
        return redirect('vendors');
    }
}
