<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //
    public function index(){
        $permissions = Permission::all(); // Fetch all permissions
    return view('permissions.index', compact('permissions'));

    }
    public function store(Request $request){
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:permissions|min:3',

        ]);
        if($validator->passes()){
          Permission::create([
            'name'=> $request->name,
          ]); 
          return redirect()->route('permissions.index')->with('success','Permission added sucessfully!');


        }else{
            return redirect()->route('permissions.create')->withErrors($validator)->withInput();
        }

    }
    public function create(){
        return view('permissions.create');
    }
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);
        if($validator->passes()){
            $permission = Permission::findOrFail($id);
            $permission->update([
            'name' => $request->name,
        ]);
            return redirect()->route('permissions.index')->with('success','Permission updated successfully!');
  
  
          }else{
              return redirect()->route('permissions.create')->withErrors($validator)->withInput();
          }
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
