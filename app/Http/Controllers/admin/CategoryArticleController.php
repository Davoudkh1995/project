<?php

namespace App\Http\Controllers\admin;

use App\CategoryArticle;
use App\CategoryService;
use App\Http\Controllers\Controller;
use App\Vw_CategoryArticles;
use foo\bar;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryArticleController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            if (!$this->authorize('article')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $items =  Vw_CategoryArticles::all();
        return view('admin.article.category.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            if (!$this->authorize('article')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $category_articles = Vw_CategoryArticles::where('status',1)->select(['title','id'])->orderbyDesc('parent_id')->get();
        return view('admin.article.category.create',compact('category_articles'));
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
            if (!$this->authorize('article')) {
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
        CategoryArticle::create([
            'title'=>$request['title'],
            'tags'=>$request['tags'],
            'parent_id'=>$request['parent_id'],
            'status'=>$status,
            'slug'=>$request['slug'],
            'usersID_FK'=>auth()->user()->id
        ]);
        return redirect(route('category_article.index'))->with('message','عملیات موفقیت آمیز بود');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoryArticle  $categoryArticle
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryArticle $categoryArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoryArticle  $categoryArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryArticle $categoryArticle)
    {
        try {
            if (!$this->authorize('article')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $category_articles = Vw_CategoryArticles::where('status',1)->select(['title','id'])->orderbyDesc('parent_id')->get();
        return view('admin.article.category.update',compact('category_articles','categoryArticle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryArticle  $categoryArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryArticle $categoryArticle)
    {
        try {
            if (!$this->authorize('article')) {
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
        $categoryArticle->update([
            'title'=>$request['title'],
            'tags'=>$request['tags'],
            'parent_id'=>$request['parent_id'],
            'slug'=>$request['slug'],
            'status'=>$status,
        ]);
        return redirect(route('category_article.index'))->with('message','عملیات موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryArticle  $categoryArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryArticle $categoryArticle)
    {
        try {
            if (!$this->authorize('article')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $subcategories = CategoryArticle::where('parent_id', $categoryArticle->id)->get();
        if (count($subcategories)) {
            foreach ($subcategories as $category) {
                $this->updateArticleToNonCategory($category);
                $category->delete();
            }
        }
        $this->updateArticleToNonCategory($categoryArticle);
        $categoryArticle->delete();
        return back()->with('message', 'عملیات موفقیت آمیز بود');
    }
}
