<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\RoleRequest;
use App\MenuDynamicTable;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        if ($this->authorize('role management')) {
        $roles = Role::where('label', '!=', 'super admin')->get();
        $superAdmin = Role::where('label', '=', 'super admin')->first();
        $isSuperAdmin = false;
        foreach ($superAdmin->users as $user) {
            if (auth()->user()->id == $user->id) {
                $isSuperAdmin = true;
            }
        }
        $users = User::where('accept_policy', 1)->get();
        return view('admin.roles.index', compact('roles', 'users', 'isSuperAdmin', 'superAdmin'));
//        }
//        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function create()
    {

//        if ($this->authorize('role_create')) {
        $users = User::all();
        $permissions = Permission::all();
        $menus = MenuDynamicTable::all();

        return view('admin.roles.create', compact('users', 'permissions', 'menus'));
//        }
//        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'label' => 'required',
            'text' => 'max:200',
        ]);
        $status = 0;
        if (isset($request['status'])) {
            $status = 1;
        }
        $role = Role::where('label', $request['label'])->first();
        if (isset($role)) {
            return back()->with('error', 'نقشی با این مشخصات موجود است');
        }
        $role = Role::create([
            'name' => $request['name'],
            'label' => $request['label'],
            'status' => $status,
            'text' => $request['text']
        ]);
        if (!is_null($request->input('permissions'))) {
            $role->permissions()->sync(
                $request->input('permissions')
            );
        }
        return back()->with('message', 'نقش جدید ایجاد شد');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $permissions = Permission::all();
        $role = Role::find($id);
        $permission_id_arr = [];
        foreach ($role->permissions as $permission) {
            array_push($permission_id_arr, $permission->id);
        }
        return view('admin.roles.update', compact('permissions', 'role', 'permission_id_arr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'label' => 'required',
            'text' => 'max:200',
        ]);
        $role = Role::find($id);
        $status = $role->status;
        if (isset($request['status'])) {
            $status = 1;
        }
        if ($role->label != $request['label']) {
            $other = Role::where('label', $request['label'])->first();
            if (isset($other)) {
                return back()->with('error', 'نقشی با این مشخصات موجود است');
            }
        }
        $role->update(['name' => $request['name'], 'label' => $request['label'], 'status' => $status, 'text' => $request['text']]);
        if (!is_null($request->input('permissions'))) {
            $role->permissions()->sync(
                $request->input('permissions')
            );
        }
        return back()->with('message','مورد ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Role::find($id);
        $permissions = $item->permissions->all();
        $users = $item->users->all();
        if (count($permissions) > 0) {
            foreach ($permissions as $permission) {
                $item->permissions()->wherePivot('permission_id', '=', $permission->id)->detach();
            }
        }
        if (count($users) > 0) {
            foreach ($users as $user) {
                $item->users()->wherePivot('user_id', '=', $user->id)->detach();
            }
        }
        $item->delete();
        return back()->with('message','مورد حذف شد');
    }

    public function remove_all(Request $request)
    {
        $ids = $request['allCheckedSelect'];
        if (count($ids) == 0) {
            Alert::error('ناموفق', 'موردی را انتخاب نکردید');
            return redirect()->back();
        }
        foreach ($ids as $id) {
            $item = Role::find($id);
            $permissions = $item->permissions->all();
            $users = $item->users->all();
            if (count($permissions) > 0) {
                foreach ($permissions as $permission) {
                    $item->permissions()->wherePivot('permission_id', '=', $permission->id)->detach();
                }
            }
            if (count($users) > 0) {
                foreach ($users as $user) {
                    $item->users()->wherePivot('user_id', '=', $user->id)->detach();
                }
            }
            $item->delete();
        }
        return response()->json(['delete' => 'success']);
    }


    public function multiRemove(Request $request)
    {
        $ids = $request['allCheckedSelect'];
        foreach ($ids as $id) {
            Role::where('id', $id)->delete();
        }
        $roles = Role::all();
        return response()->json(['delete' => 'success', 'roles' => $roles]);
    }

    public function singleRemove(Request $request)
    {
        $id = $request['roleId'];
        Role::where('id', $id)->delete();
        $roles = Role::all();
        return response()->json(['delete' => 'success', 'roles' => $roles]);
    }

    public function searchTitle(Request $request)
    {
        $title = $request['value'];

        if (sizeof($title) > 0) {
            $roles = DB::table('roles')
                ->where('name', 'like', "%$title%")
                ->get();
        } else {
            $roles = Role::all();
        }

        $size = count($roles);

        return response()->json(['arrive' => 'success', 'roles' => $roles, 'size' => $size]);
    }
}
