<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Reception;
use App\Role;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
use Redirect;

class UserController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        try {
            if (!$this->authorize('user')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $admins = User::orderBy('id', 'asc')->get();
        $status = false;
        $isSuperAdmin = false;
        foreach ($admins as $key => $admin) {
            foreach ($admin->roles as $role)
                if ($role->label == "superadmin") {
                    $status = true;
                }
            if ($status) {
                if (auth()->user()->id == $admin->id) {
                    $isSuperAdmin = true;
                }
                $super_admin = $admin;
                $admins->forget($key);
                $status = false;
            }
        }
        return view('admin.users.index', compact('admins', 'super_admin', 'isSuperAdmin'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        try {
            if (!$this->authorize('user')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $user = auth()->user();
        $role = $user->roles()->get()->first();
        $roleName = $role['name'];
        $roles = Role::where('label', '!=', 'superadmin')->get();
        $superAdmin = Role::where('label', '=', 'superadmin')->first();
        $isSuperAdmin = false;
        foreach ($superAdmin->users as $user) {
            if (auth()->user()->id == $user->id) {
                $isSuperAdmin = true;
            }
        }
        return view('admin.users.create', compact('roles', 'roleName', 'isSuperAdmin', 'superAdmin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (!$this->authorize('user')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'name' => 'required',
            'nationalCode' => 'required',
            'picture' => 'mimes:jpeg,bmp,png',
            'signature' => 'mimes:jpeg,bmp,png',
        ]);
        if ($request['roleId'] == 0) {
            return back()->with('error', 'هیچ نقشی انتخاب نشده!');
        }
        if (!isset($request['password']) and !isset($request['confirm'])) {
            return back()->with('message', 'رمز و تکرار آن وارد نشده');
        }
        if (isset($request['accept_policy'])) {
            $status = 1;
        } else {
            $status = 0;
        }
        if ($request['password'] != $request['confirm']) {
            return back()->with('error', 'رمز یا تکرار آن یکسان نیستند');
        }
        $existedUser = User::where('nationalCode', $request['nationalCode'])->first();
        if (isset($existedUser)) {
            return back()->with('message', 'نام کاربری تکراری میباشد!');
        }
        $targetPic = "/upload/images/admin/picture/";
        $targetSig = "/upload/images/admin/signature/";
        $signature = $request->file('signature');
        $picture = $request->file('picture');
        if (isset($signature)) {
            $signature = $this->uploadFile($signature, $targetSig);
        } else {
            $signature = null;
        }
        if (isset($picture)) {
            $picture = $this->uploadFile($picture, $targetPic);
        } else {
            $picture = null;
        }
        $user_current_email = User::where('email', $request['email'])->first();
        $user_current_nationalCode = User::where('nationalCode', $request['nationalCode'])->first();
        if (isset($user_current_email) or isset($user_current_nationalCode)) {
            return back()->with('error', 'پست الکترونیکی یا نام کاربری تکراری است');
        }
        $password = bcrypt($request['password']);
        $user = User::create([
            'picture' => $picture,
            'signature' => $signature,
            'name' => $request['name'],
            'password' => $password,
            'nationalCode' => $request['nationalCode'],
            'username' => $request['nationalCode'],
            'email' => $request['email'],
            'type' => $request['type'],
            'accept_policy' => $status
        ]);
        if (!is_null($request->input('roleId'))) {
            $user->roles()->sync(
                $request->input('roleId')
            );
        }
        return redirect(route('admin.edit', $user->id))->with('message', 'مورد ایجاد شد');
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
        try {
            if (!$this->authorize('user')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }
        $admin = User::find($id);
        $roles = Role::where('label', '!=', 'superadmin')->get();
        $superAdmin = Role::where('label', '=', 'superadmin')->first();
        $isSuperAdmin = false;
        foreach ($superAdmin->users as $user) {
            if (auth()->user()->id == $user->id) {
                $isSuperAdmin = true;
            }
        }
        $role_id_arr = [];
        foreach ($admin->roles as $role) {
            array_push($role_id_arr, $role->id);
        }
        return view('admin.users.update', compact('admin', 'roles', 'role_id_arr', 'superAdmin', 'isSuperAdmin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if (!$this->authorize('user')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'name' => 'required',
            'nationalCode' => 'required',
            'picture' => 'mimes:jpeg,bmp,png',
            'signature' => 'mimes:jpeg,bmp,png',
        ]);
        if ($request['roleId'] == 0) {
            return back()->with('error', 'هیچ نقشی انتخاب نشده!');
        }
        if (isset($request['accept_policy'])) {
            $status = 1;
        } else {
            $status = 0;
        }
        $existedUser = User::where('nationalCode', $request['nationalCode'])->first();
        $currentUser = User::find($id);
        if (($currentUser->nationalCode != $request['nationalCode']) and isset($existedUser)) {
            return back()->with('message', 'نام کاربری تکراری میباشد!');
        }
        if ($request['password'] != null) {
            if ($request['password'] != $request['confirm']) {
                return back()->with('error', 'رمز یا تکرار آن یکسان نیستند');
            }
            User::find($id)->update([
                'password' => bcrypt($request['password'])
            ]);
        }
        $signature = $request->file('signature');
        $picture = $request->file('picture');
        $targetPic = "/upload/images/admin/picture/";
        $targetSig = "/upload/images/admin/signature/";
        if (isset($signature)) {
            $this->removeFile($currentUser->signature);
            $signature = $this->uploadFile($signature, $targetSig);
            $currentUser->update([
                'signature' => $signature,
            ]);
        }
        if (isset($picture)) {
            $this->removeFile($currentUser->picture);
            $picture = $this->uploadFile($picture, $targetPic);
            $currentUser->update([
                'picture' => $picture,
            ]);
        }
        $currentUser->update([
            'name' => $request['name'],
            'nationalCode' => $request['nationalCode'],
            'username' => $request['nationalCode'],
            'email' => $request['email'],
            'type' => $request['type'],
            'accept_policy' => $status
        ]);
        $currentUser->roles()->sync(
            $request->input('roleId')
        );
        return back()->with('message', 'مورد ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        try {
            if (!$this->authorize('user')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }
        $item = User::find($id);
        $roles = $item->roles->all();
        if (count($roles) > 0) {
            foreach ($roles as $role) {
                $item->roles()->wherePivot('role_id', '=', $role->id)->detach();
            }
        }
        $item->delete();
        return back()->with('message', 'مورد حذف شد');
    }

    public function remove_all(Request $request)
    {
        try {
            if (!$this->authorize('user')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }
        $ids = $request['ids'];
        $ids = explode(',', $ids);
        foreach ($ids as $id) {
            $item = User::find($id);
            $roles = $item->roles->all();
            if (count($roles) > 0) {
                foreach ($roles as $role) {
                    $item->roles()->wherePivot('role_id', '=', $role->id)->detach();
                }
            }
            $item->delete();
        }
        return redirect(route('admin.index'))->with('message', 'عملیات موفقیت آمیز بود');
    }

    /*public function remove_all(Request $request)
    {
        $ids = $request['allCheckedSelect'];
        if (count($ids) == 0) {
            back()->with('message', 'موردی را انتخاب نکردید');
        }
        foreach ($ids as $id) {
            $item = User::find($id);
            $roles = $item->roles->all();
            if (count($roles) > 0) {
                foreach ($roles as $role) {
                    $item->roles()->wherePivot('role_id', '=', $role->id)->detach();
                }
            }
            $item->delete();
        }
        return response()->json(['delete' => 'success']);
    }*/
}
