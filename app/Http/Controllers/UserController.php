<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return[
            new Middleware('permission:view users',only:['index']),
            new Middleware('permission:edit users',only:['edit']),
            new Middleware('permission:create users',only:['create']),
            new Middleware('permission:delete users',only:['destroy']),
        ];
    }
    public function create()
{
    return view('users.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}
    //
    public function index(){
        $users = User::latest()->paginate(10);
        return view("users.index",compact("users"));
    }
    public function edit($id){
        $roles = Role::orderBy("name",'asc')->get();
        $user = User::findOrFail($id);
        $hasRoles = $user->roles->pluck('id'); 
        return view("users.edit",[
            "user"=> $user,
            "roles"=> $roles,
            "hasRoles"=> $hasRoles,
        ]);
    }
    public function update(Request $request, $id){
        $user = User::findOrFail($id); 
        $validator = Validator::make($request->all(), [
            'name'=> 'required|min:3',
            'email'=> 'required|email|unique:users,email,'.$id.',id'
        ]);
        
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success' ,'User updated and assigned role sucessfully');
        
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
