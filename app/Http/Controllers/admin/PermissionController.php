<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\PermissionRequest;
use App\MenuDynamicTable;
use App\Permission;
use App\Role;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
use Redirect;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        if ($this->authorize('permission management') != null) {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
//        }
//        abort(403);


//        $this->authorize('access_section');
//        $permissions= Permission::paginate(10);
//        return view('admin.admin.permissions.list',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//        if ($this->authorize('permission_create')) {
        $roles = Role::where('label', '!=', 'super admin')->get();
        $isSuperAdmin = false;
        $superAdmin = Role::where('label', '=', 'super admin')->first();
        foreach ($superAdmin->users as $user) {
            if (auth()->user()->id == $user->id) {
                $isSuperAdmin = true;
            }
        }
        return view('admin.permissions.create', compact('roles', 'isSuperAdmin', 'superAdmin'));
//        } else {
//            abort(403);
//        }


        /* $this->authorize('access_section');
         $roles= Role::all()->toArray();
         return view('admin.admin.permissions.insert',compact('roles'));*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'label' => 'required',
        ]);
        $status = 0;
        if (isset($request['status'])) {
            $status = 1;
        }
        $permissions = Permission::select('label')->get();
        foreach ($permissions as $each) {
            if ($each->label == $request['label']) {
                return back()->with('error', 'فیلد نام به انگلیسی تکراریست یک نام دیگر انتخاب کنید');
            }
        }
        $permission = Permission::create(['name' => $request['name'], 'label' => $request['label'], 'status' => $status]);
        MenuDynamicTable::create(['name' => $label, 'permission_id' => $permission->id]);
        if (!is_null($request->input('role'))) {
            $permission->roles()->sync(
                $request->input('role')
            );
        }
        return back()->with('message', 'اجازه دسترسی ایجاد شد');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

//        if ($this->authorize('access_section') != null) {
//            $this->authorize('access_section');
        $roles = Role::where('label', '!=', 'super admin')->get();
        $permission = Permission::find($id);
        $superAdmin = Role::where('label', '=', 'super admin')->first();
        $isSuperAdmin = false;
        foreach ($superAdmin->users as $user) {
            if (auth()->user()->id == $user->id) {
                $isSuperAdmin = true;
            }
        }
        $role_id_arr = [];
        foreach ($permission->roles as $role) {
            array_push($role_id_arr, $role->id);
        }
        return view('admin.permissions.update', compact('permission', 'roles', 'role_id_arr', 'superAdmin', 'isSuperAdmin'));


        /*$this->authorize('access_section');
        $roles= Role::all()->toArray();
        $permission = Permission::find($id);

        if (isset($permission->roles()->get()->first()->id)){
            $roleId= $permission->roles()->get()->first()->id;
            if (isset($roleId)){
                $rId = $roleId;
            }else{
                $rId = 0;
            }
        }
        return view('admin.admin.permissions.edit',compact('id','rId','permission','roles'));*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'label' => 'required',
        ]);
        $permission = Permission::find($id);
        if (isset($request['status'])) {
            $status = 1;
        } else {
            $status = 0;
        }
        $permissions = Permission::select('label')->get();
        foreach ($permissions as $each) {
            if ($permission->label != $request['label']) {
                if ($each->label == $request['label']) {
                    return back()->with('error', 'فیلد نام به انگلیسی تکراریست یک نام دیگر انتخاب کنید');
                }
            }
        }
        $menuDynamicTable = MenuDynamicTable::where('permission_id', $permission->id)->first();
        $menuDynamicTable->update(['name' => $request['label']]);
        $permission->update([
            'name' => $request['name'],
            'label' => $request['label'],
            'status' => $status
        ]);
        if (!is_null($request->input('role'))) {
            $permission->roles()->sync(
                $request->input('role')
            );
        }
        return back()->with('message', 'دسترسی ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Permission::find($id);
        $roles = $item->roles->all();
        if (count($roles) > 0) {
            foreach ($roles as $role) {
                $item->roles()->wherePivot('role_id', '=', $role->id)->detach();
            }
        }
        $menuDynamicTable = MenuDynamicTable::where('permission_id', $item->id)->first();
        $menuDynamicTable->delete();
        $item->delete();
        return back()->with('message', 'دسترسی حذف شد');
    }

    public function remove_all(Request $request)
    {
        $ids = $request['allCheckedSelect'];
        if (count($ids) == 0) {
            return back()->with('message', 'موردی را انتخاب نکردید');
        }
        foreach ($ids as $id) {
            $item = Permission::find($id);
            $roles = $item->roles->all();
            if (count($roles) > 0) {
                foreach ($roles as $role) {
                    $item->roles()->wherePivot('role_id', '=', $role->id)->detach();
                }
            }
            $menuDynamicTable = MenuDynamicTable::where('permission_id', $item->id)->first();
            $menuDynamicTable->delete();
            $item->delete();
        }
        return response()->json(['delete' => 'success']);
    }


    public function multiRemove(Request $request)
    {
        $ids = $request['allCheckedSelect'];
        foreach ($ids as $id) {
            Permission::where('id', $id)->delete();
        }
        $permissions = Permission::all();
        return response()->json(['delete' => 'success', 'permissions' => $permissions]);
    }

    public function singleRemove(Request $request)
    {
        $id = $request['permissionId'];
        Permission::where('id', $id)->delete();
        $permissions = Role::all();
        return response()->json(['delete' => 'success', 'permissions' => $permissions]);
    }

    public function searchTitle(Request $request)
    {
        $title = $request['value'];

        if (sizeof($title) > 0) {
            $permissions = DB::table('permissions')
                ->where('name', 'like', "%$title%")
                ->get();
        } else {
            $permissions = Role::all();
        }

        $size = count($permissions);

        return response()->json(['arrive' => 'success', 'permissions' => $permissions, 'size' => $size]);
    }

}
