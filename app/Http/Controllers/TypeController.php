<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
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

        $type = Type::create($input);

        notify()->flash('You have successfully created a type', 'success');

        return redirect('types')->withInput();
    }

    public function edit($id)
    {
        $type = Type::findOrFail($id);
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

        $type->update($input);

        notify()->flash('You have successfully edited the type', 'success');

        return redirect('types')->withInput();
    }

    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        $type->delete();
        notify()->flash('You have successfully deleted a type', 'success');
        return redirect('types');
    }
}
