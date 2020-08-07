<?php

namespace App\Http\Controllers\admin;

use App\CategoryPortfolio;
use App\Http\Controllers\Controller;
use App\Portfolio;
use App\Vw_CategoryPortfolio;
use Illuminate\Http\Request;

class CategoryPortfolioController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Vw_CategoryPortfolio::all();
        return view('admin.portfolio.category.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_portfolio = Vw_CategoryPortfolio::all();
//        dd($category_services);
//        $parents = Vw_CategoryServices::where('status',1)->select(['title','id'])->where('parent_id',0)->orderbyDesc('parent_id')->get();
        /*if (count($parents)){
            foreach ($parents as $parent){
                $subparents = Vw_CategoryServices::where('status',1)->select(['title','id'])->where('parent_id',$parent->id)->orderbyDesc('parent_id')->get();
                if (count($subparents)){

                }
            }
        }*/

        return view('admin.portfolio.category.create', compact('category_portfolio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = 0;
        if (isset($request['status'])) {
            $status = 1;
        }
        CategoryPortfolio::create([
            'title' => $request['title'],
            'tags' => $request['tags'],
            'slug' => $request['slug'],
            'parent_id' => $request['parent_id'],
            'status' => $status,
            'usersID_FK' => auth()->user()->id
        ]);
        return redirect(route('category_portfolio.index'))->with('message', 'عملیات موفقیت آمیز بود');;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\CategoryPortfolio $categoryPortfolio
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryPortfolio $categoryPortfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\CategoryPortfolio $categoryPortfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryPortfolio $categoryPortfolio)
    {
        $category_portfolios = Vw_CategoryPortfolio::where(['status' => 1])->where('parent_id', '!=', $categoryPortfolio->id)->select(['title', 'id'])->orderbyDesc('parent_id')->get();
        return view('admin.portfolio.category.update', compact('category_portfolios', 'categoryPortfolio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\CategoryPortfolio $categoryPortfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryPortfolio $categoryPortfolio)
    {
        $status = 0;
        if (isset($request['status'])) {
            $status = 1;
        }
        $categoryPortfolio->update([
            'title' => $request['title'],
            'tags' => $request['tags'],
            'parent_id' => $request['parent_id'],
            'slug' => $request['slug'],
            'status' => $status,
        ]);
        return redirect(route('category_portfolio.index'))->with('message', 'عملیات موفقیت آمیز بود');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\CategoryPortfolio $categoryPortfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryPortfolio $categoryPortfolio)
    {
        $subcategories = CategoryPortfolio::where('parent_id', $categoryPortfolio->id)->get();
        if (count($subcategories)) {
            foreach ($subcategories as $category) {
                $this->updatePortfolioToNonCategory($category);
                $category->delete();
            }
        }
        $this->updatePortfolioToNonCategory($categoryPortfolio);
        $categoryPortfolio->delete();
        return back()->with('message', 'عملیات موفقیت آمیز بود');
    }




    public function destroy_all(Request $request)
    {
        dd($request->all());
    }
}
