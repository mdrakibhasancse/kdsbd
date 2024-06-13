<?php

namespace Cp\UserRole\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class AdminUserRoleController extends Controller
{
    public function usersAll(Request $request)
    {
        menuSubmenu('users', 'usersAll');
        if ($request->id) {
            $data['users'] = User::where('id', $request->id)->paginate(10);
        }else{
            $data['users'] = $users = User::latest()->paginate(100);
        }
        return view('userrole::admin.users.usersAll', $data);
    }

    public function userCreate()
    {
        return view('userrole::admin.users.userCreate');
    }


    public function userStore(Request $request)
    {


        $request->merge([
            'mobile' => $request->valid_mobile,
        ]);

        $validation = Validator::make(
            $request->all(),
            [
                'name'     => 'required|string',
                'email'    => 'required|email|unique:users,email',
                'mobile'    => 'required|unique:users,mobile',
                'password' => 'required|min:8',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()
                ->withInput()
                ->withErrors($validation);
        }


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->password_temp = $request->password;
        $user->mobile = $request->mobile;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('users/' . $imageName, File::get($file));
            $user->image = $imageName;
        }
        $user->save();
        toast('User successfully Created', 'success');
        return redirect()->back();
    }



    public function userEdit(User $user)
    {
        $data['user'] = $user;
        return view('userrole::admin.users.userEdit', $data);
    }


    public function userUpdate(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'email'    => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->mobile = $request->mobile;

        if ($request->hasFile('image')) {
            $old_file = 'users/' . $user->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('users/' . $imageName, File::get($file));
            $user->image = $imageName;
        }
        $user->save();
        toast('User successfully Updated', 'success');
        return redirect()->back();
    }




    public function userDelete(User $user)
    {
        $old_file = 'users/' . $user->image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $user->delete();
        toast('User successfully Deleted', 'success');
        return redirect()->back();
    }


    public function rolesAll()
    {
        menuSubmenu('rolepermission', 'rolesAll');
        $data['roles'] = Role::orderBy('id', 'DESC')->paginate(20);
        $data['permissions'] = Permission::get();
        return view('userrole::admin.roles.rolesAll', $data);
    }

    public function roleCreate()
    {
        // menuSubmenu('rolepermission', 'roleCreate');
        $data['permissions'] = Permission::get();
        return view('userrole::admin.roles.roleCreate', $data);
    }

    public function roleStore(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);
        if ($validation->fails()) {
            toast('Role name and atleast one permission are required', 'error');
            return redirect()->back()->withInput();
        }


        $role = Role::create(['name' => $request->input('role_name')]);
        $role->syncPermissions($request->input('permissions'));

        toast('Role successfully Created', 'success');
        return redirect()->back();
    }

    public function roleShow(Role $role)
    {
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get();

        return view('userrole::admin.roles.roleShow', compact('role', 'rolePermissions'));
    }



    public function roleEdit(Role $role)
    {
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('userrole::admin.roles.roleEdit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function roleUpdate(Request $request, Role $role)
    {
        $validation = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required',
        ]);
        if ($validation->fails()) {
            toast('Role name and atleast one permission are required', 'error');
            return redirect()->back()->withInput();
        }

        if ($role->name == 'admin') {
            toast('Admin role can not be updated', 'error');
            return redirect()->back();
        }
        $role->name = $request->input('role_name');
        $role->save();

        $role->syncPermissions($request->input('permissions'));

        toast('Role updated successfully', 'success');
        return redirect()->back();
    }

    public function roleDelete(Role $role)
    {
        // Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
        //     ->where("role_has_permissions.role_id", $role->id)
        //     ->delete();
        $role->delete();
        toast('Role successfully Deleted', 'success');
        return back();
    }


    public function permissionsAll()
    {
        $data['permissions'] = Permission::orderBy('id', 'DESC')->paginate(100);
        menuSubmenu('rolepermission', 'permissionsAll');
        return view('userrole::admin.permissions.permissionsAll', $data);
    }


    public function permissionStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = Permission::create(['name' => $request->input('name')]);
        $permission->assignRole('admin');
        toast('Permission successfully Created', 'success');
        return redirect()->back()->withInput();
    }

    public function permissionEdit(Permission $permission)
    {
        $data['permission'] = $permission;
        return view('userrole::admin.permissions.permissionEdit', $data);
    }

    public function permissionUpdate(Request $request, Permission $permission)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        if ($validation->fails()) {
            toast('Permission name is required and unique', 'error');
            return redirect()->back()->withInput();
        }

        $permission->name = $request->input('name');
        $permission->save();


        toast('Permission updated successfully', 'success');

        return redirect()->route('admin.permissionsAll');
    }

    public function permissionDelete(Permission $permission)
    {
        $permission->delete();
        toast('Permission deleted successfully', 'success');
        return redirect()->route('admin.permissionsAll');
    }

    public function permissionSearch(Request $request)
    {
        $q = $request->q;
        $permissions = Permission::where(function ($qq) use ($q) {
            $qq->orWhere('name', 'like', "%" . $q . "%")
                ->orWhere('id', 'like', "%" . $q . "%");
        })->orderBy('name')
            ->paginate(100);
        $permissions->appends($request->all());
        $page = View('userrole::admin.permissions.searchData', ['permissions' => $permissions])->render();
        return response()->json([
            'success' => true,
            'page' => $page,
        ]);
    }

    public function assignRole()
    {
        menuSubmenu('rolepermission', 'assignRole');
        $users = User::select(['id', 'email', 'name'])->get();
        $roles = Role::latest()->get();
        $roleUsers = User::has('roles')->with('roles')->paginate(100);
        return view('userrole::admin.users.asignRole', compact('users', 'roles', 'roleUsers'));
    }

    public function assignRoleStore(Request $request,)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'role_ids' => 'required',
        ]);

        $user = User::findOrFail($request->user_id);
        if (!$user) {
            return back();
        }

        if ($request->role_ids) {
            $user->syncRoles($request->role_ids);
        }


        toast('Role Asign successfully', 'success');
        return redirect()->back();
    }


    public function roleUsers()
    {
        menuSubmenu('rolepermission', 'mangeRole');

        $users = User::has('roles')->with('roles')->paginate(100);

        return view('userrole::admin.users.roleUsers', compact('users'));
    }


    public function roleDetach(User $user)
    {
        if ($user->id == Auth::id()) {
            toast('You can not delete by userself', 'error');
            return back();
        }
        $user->roles()->detach();
        toast('Role Detach successfully', 'success');
        return redirect()->back();
    }

    public function ajaxUserSearch(Request $request)
    {
        $q = $request->q;
        $user = User::where('name', 'like', '%' . $q . '%')
            ->orderBy('name')->get();
        return $user;
    }

    public function userSearch(Request $request)
    {
        $q = $request->q;
        $users = User::where(function ($qq) use ($q) {
            $qq->orWhere('name', 'like', "%" . $q . "%")
                ->orWhere('email', 'like', "%" . $q . "%")
                ->orWhere('mobile', 'like', "%" . $q . "%")
                ->orWhere('id', 'like', "%" . $q . "%");
        })->orderBy('name')
            ->paginate(100);
        $users->appends($request->all());
        $page = View('userrole::admin.users.searchData', ['users' => $users])->render();
        return response()->json([
            'success' => true,
            'page' => $page,
        ]);
    }
}