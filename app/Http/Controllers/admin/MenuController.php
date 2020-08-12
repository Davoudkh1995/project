<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Page;
use App\Vw_Menus;
use foo\bar;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (!$this->authorize('menu')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $items = Vw_Menus::orderbyDesc('created_at')->get();
//        $items = \DB::select('select * from vw_menus');
        return view('admin.menu.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            if (!$this->authorize('menu')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $menus = Vw_Menus::where('status',1)->select(['title','id'])->get();
//        $menus = \DB::select('select * from vw_menus');
        return view('admin.menu.create',compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (!$this->authorize('menu')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'slug' => 'required',
        ]);
        $status = 0;
        if (isset($request['status'])){
            $status = 1;
        }
        $address = \Illuminate\Support\Facades\App::make('url')->to('/site').'/'.$request['slug'];
        Menu::create([
            'usersID_FK' => auth()->user()->id,
            'parent_id' => $request['parent_id'],
            'status' => $status,
            'lang' => $request['lang'],
            'url' => $address,
            'title' => $request['title'],
            'slug' => $request['slug'],
        ]);
        return redirect(route('menu.index'))->with('message','عملیات موفقیت آمیز بود');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        try {
            if (!$this->authorize('menu')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $menus = Vw_Menus::where('status',1)->select(['title','id'])->get();
//        $menus = \DB::select('select * from vw_menus');
        return view('admin.menu.update',compact('menus','menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        try {
            if (!$this->authorize('menu')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'slug' => 'required',
        ]);
        $status = 0;
        if (isset($request['status'])){
            $status = 1;
        }
        $address = \Illuminate\Support\Facades\App::make('url')->to('/site').'/'.$request['slug'];
        $menu->update([
            'parent_id'=>$request['parent_id'],
            'status'=>$status,
            'lang' => $request['lang'],
            'url'=>$address,
            'title'=>$request['title'],
            'slug'=>$request['slug'],
        ]);
        return redirect(route('menu.index'))->with('message','عملیات موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        try {
            if (!$this->authorize('menu')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }
        $submenus = Menu::select(['id'])->where(['parent_id'=>$menu->id])->get();
        if (count($submenus)) {
            foreach ($submenus as $submenu) {
                $page = Page::where(['menu_id'=>$submenu->id]);
                if (isset($page)){
                    $page->delete();
                }
                $submenu->delete();
            }
        }
        $page = Page::where(['menu_id'=>$menu->id]);
        $page->delete();
        $menu->delete();
        return back()->with('menu.index', 'عملیات موفقیت آمیز بود');
    }

    public function pageCreator(Request $request)
    {
        try {
            if (!$this->authorize('menu')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $page = Page::where(['menu_id'=>$request['menu_id']])->first();
        if ($page){
            $page->update([
                'content'=>$request['content'],
                'lang' => $request['lang']
            ]);
        }else{
            $page = Page::create([
                'content'=>$request['content'],
                'lang' => $request['lang']
            ]);
        }
        $menu = Menu::find($request['menu_id']);
        $menu->page()->save($page);
        return redirect(route('menu.edit',$request['menu_id']))->with(['showPageCreator'=>'on']);
    }

    public function front_page($slug)
    {
        $menu = Menu::where('slug','like',$slug)->first();
        if (isset($menu->page)){
            $content = $menu->page->content;
            return view('front.page',compact('content'));
        }else{
            abort(404);
        }
    }
}
