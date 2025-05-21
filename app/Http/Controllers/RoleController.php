<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    public function index(){
        $roles = Role::orderBy("name",'asc')->paginate(10);
        return view('roles.index',[
            'roles'=> $roles
        ]);
        

    }
    public function store(Request $request){
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:roles|min:3',

        ]);
        if($validator->passes()){
         $role = Role::create([
            'name'=> $request->name,
          ]); 
          if(!empty($request->permission)){
            foreach($request->permission as $name){
                $role->givePermissionTo($name);
            }
          }
          return redirect()->route('roles.index')->with('success','Role added sucessfully!');


        }else{
            return redirect()->route('roles.create')->withErrors($validator)->withInput();
        }


    }
    public function create(){
        $permissions = Permission::orderBy( 'name','asc')->get();
        return view('roles.create',[
            'permissions'=> $permissions,
        ]);

    }
    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:roles,name,' . $id . '|min:3',
    ]);

    if ($validator->passes()) {
        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name,
        ]);

        // Sync permissions
        if (!empty($request->permission)) {
            $role->syncPermissions($request->permission);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    } else {
        return redirect()->route('roles.edit', $id)->withErrors($validator)->withInput();
    }
}

public function destroy($id)
{
    $role = Role::findOrFail($id);
    $role->delete();

    return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
}
public function edit($id)
{
    $permissions = Permission::all();
    $roles = Role::findOrFail($id);
    return view('roles.edit', compact('roles', 'permissions'));
}


}
