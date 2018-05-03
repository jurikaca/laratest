<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;
use Auth;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $types = Type::all();
        return view('types.index', compact('types'));
    }

    public function create()
    {
        return view('types.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'min:1', 'max:200', 'unique:types'],
        ];

        $this->validate($request, $rules);

        $input = $request->all();

        $input['creator_id'] = Auth::user()->id;

        $type = Type::create($input);

        notify()->flash('You have successfully created a type', 'success');

        return redirect('types')->withInput();
    }

    public function edit($id)
    {
        $type = Type::findOrFail($id);
        if(Auth::user()->role != User::ADMIN && $type->creator_id != Auth::user()->id){
            notify()->flash('You dont have permission to edit this type', 'warning');
            return redirect('types');
        }
        return view('types.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => ['required', 'min:1', 'max:200'],
        ];

        $this->validate($request, $rules);

        $input = $request->all();
        $type = Type::findOrFail($id);
        if(Auth::user()->role != User::ADMIN && $type->creator_id != Auth::user()->id){
            notify()->flash('You dont have permission to edit this type', 'warning');
            return redirect('types');
        }

        $type->update($input);

        notify()->flash('You have successfully edited the type', 'success');

        return redirect('types')->withInput();
    }

    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        if(Auth::user()->role != User::ADMIN && $type->creator_id != Auth::user()->id){
            notify()->flash('You dont have permission to delete this type', 'warning');
            return redirect('types');
        }
        $type->delete();
        notify()->flash('You have successfully deleted a type', 'success');
        return redirect('types');
    }
}
