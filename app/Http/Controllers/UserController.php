<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $users = User::all();
        $roles = User::getRoles();
        return view('users.index', compact('users'), compact('roles'));
    }

    public function create()
    {
        $roles = User::getRoles();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $rules = [
            'username' => ['required', 'min:3', 'max:64', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:5'],
            'role' => ['required'],
        ];

        $this->validate($request, $rules);

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        notify()->flash('You have successfully created an user', 'success');

        return redirect('users')->withInput();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = User::getRoles();
        return view('users.edit', compact('user'), compact('roles'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'username' => ['required', 'min:3', 'max:64', 'unique:users,username,'.$id],
            'email' => ['required', 'email', 'unique:users,email,'.$id],
            'role' => ['required'],
        ];
        $input = $request->all();
        if($input['password'] == ''){
            unset($input['password']);
        }else{
            $rules['password'] = ['required', 'min:5'];
        }

        $this->validate($request, $rules);
        if(isset($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }

        $user = User::findOrFail($id);

        $user->update($input);

        notify()->flash('You have successfully edited an user', 'success');

        return redirect('users')->withInput();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        notify()->flash('You have successfully deleted an user', 'success');

        return redirect('users');
    }

    public function change_user_role(Request $request){
        $input = $request->all();
        $user = User::findOrFail($input['user_id']);
        $user->role = $input['role'];
        $user->update();
        return response()->json([
            'success' => true,
            'msg'   =>  'User role was successfully changed.'
        ]);
    }

    public function change_user_active(Request $request){
        $input = $request->all();
        $user = User::findOrFail($input['user_id']);
        if(isset($input['active']) && $input['active'] == 1){
            $user->isActive = 1;
        }else{
            $user->isActive = 0;
        }
        $user->update();
        return response()->json([
            'success' => true,
            'msg'   =>  'Active Status was successfully changed for this user.'
        ]);
    }
}