<?php

namespace App\Http\Controllers\admin;

use App\CategoryService;

use App\Vw_CategoryServices;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CategoryServiceController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            if (!$this->authorize('service')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $items = Vw_CategoryServices::all();
        return view('admin.service.category.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            if (!$this->authorize('service')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $category_services = Vw_CategoryServices::all();
//        dd($category_services);
//        $parents = Vw_CategoryServices::where('status',1)->select(['title','id'])->where('parent_id',0)->orderbyDesc('parent_id')->get();
        /*if (count($parents)){
            foreach ($parents as $parent){
                $subparents = Vw_CategoryServices::where('status',1)->select(['title','id'])->where('parent_id',$parent->id)->orderbyDesc('parent_id')->get();
                if (count($subparents)){

                }
            }
        }*/

        return view('admin.service.category.create', compact('category_services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (!$this->authorize('service')) {
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
        if (isset($request['status'])) {
            $status = 1;
        }
        CategoryService::create([
            'title' => $request['title'],
            'tags' => $request['tags'],
            'slug' => $request['slug'],
            'lang' => $request['lang'],
            'parent_id' => $request['parent_id'],
            'status' => $status,
            'usersID_FK' => auth()->user()->id
        ]);
        return redirect(route('category_service.index'))->with('message', 'عملیات موفقیت آمیز بود');;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\CategoryService $categoryService
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryService $categoryService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\CategoryService $categoryService
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryService $categoryService)
    {
        try {
            if (!$this->authorize('service')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $category_services = Vw_CategoryServices::where('status', 1)->where('parent_id', '!=', $categoryService->id)->select(['title', 'id'])->orderbyDesc('parent_id')->get();
        $seo = $categoryService->seo;
        return view('admin.service.category.update', compact('category_services', 'categoryService','seo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\CategoryService $categoryService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryService $categoryService)
    {
        try {
            if (!$this->authorize('service')) {
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
        if (isset($request['status'])) {
            $status = 1;
        }
        $categoryService->update([
            'title' => $request['title'],
            'tags' => $request['tags'],
            'slug' => $request['slug'],
            'lang' => $request['lang'],
            'parent_id' => $request['parent_id'],
            'status' => $status,
        ]);
        return redirect(route('category_service.index'))->with('message', 'عملیات موفقیت آمیز بود');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\CategoryService $categoryService
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryService $categoryService)
    {
        try {
            if (!$this->authorize('service')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $subcategories = CategoryService::where('parent_id', $categoryService->id)->get();
        if (count($subcategories)) {
            foreach ($subcategories as $category) {
                $this->updateServiceToNonCategory($category);
                $category->delete();
            }
        }
        $this->updateServiceToNonCategory($categoryService);
        $categoryService->delete();
        return back()->with('message', 'عملیات موفقیت آمیز بود');
    }

    public function remove_all(Request $request)
    {
        try {
            if (!$this->authorize('service')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }
        $ids = $request['ids'];
        $ids = explode(',', $ids);
        foreach ($ids as $id) {
            $categoryService = CategoryService::find($id);
            $subcategories = CategoryService::where('parent_id', $categoryService->id)->get();
            if (count($subcategories)) {
                foreach ($subcategories as $category) {
                    $this->updateServiceToNonCategory($category);
                    $category->delete();
                }
            }
            $this->updateServiceToNonCategory($categoryService);
            $categoryService->delete();
        }
        return redirect(route('category_service.index'))->with('message', 'عملیات موفقیت آمیز بود');
    }

    public function save_seo_service_cat(Request $request)
    {
        $id = $request['object'];
        $item = CategoryService::find($id);
        $seo = Seo::find($item->seo_id);
        if (isset($object)) {
            $index = 0;
            $follow = 0;
            if (isset($request['index'])) {$index = 1;}
            if (isset($request['follow'])) {$follow = 1;}
            $seo->update([
                'index'=>$index,
                'follow'=>$follow,
                'title'=>$request['title'],
                'description'=>$request['description'],
                'keywords'=>$request['keywords'],
                'seo_url'=>$request['seo_url'],
                'canonical'=>$request['canonical'],
            ]);
        } else {
            $index = 0;
            $follow = 0;
            if (isset($request['index'])) {$index = 1;}
            if (isset($request['follow'])) {$follow = 1;}
            $seo = Seo::create([
                'index'=>$index,
                'follow'=>$follow,
                'title'=>$request['title'],
                'description'=>$request['description'],
                'keywords'=>$request['keywords'],
                'seo_url'=>$request['seo_url'],
                'canonical'=>$request['canonical'],
            ]);
        }
        $item->update([
            'seo_id'=> $seo->id
        ]);
        return back()->with('massage', 'تغییرات صورت گرفت');
    }
}
