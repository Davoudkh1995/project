<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\ImageModel;
use App\Portfolio;
use App\Vw_CategoryPortfolio;
use App\Vw_Portfolio;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

class PortfolioController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (!$this->authorize('portfolio')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $items = Vw_Portfolio::orderbyDesc('created_at')->get();
        /*$obj = $items[0]->picture;
        $decode = \GuzzleHttp\json_decode($obj);
        dd($obj->main);*/
        return view('admin.portfolio.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {try {
        if (!$this->authorize('portfolio')) {
            abort(403);
        }
    } catch (AuthorizationException $e) {
        abort(403);
    }

        $categories = Vw_CategoryPortfolio::where(['status' => 1])->get();
        $priority_arr = Vw_Portfolio::where('priority', '!=', 0)->select(['priority'])->get();
        $priorities = [1, 2, 3];
        $priority_ids = [];
        foreach ($priority_arr as $p) {
            array_push($priority_ids, $p->priority);
        }
        foreach ($priority_ids as $priority) {
            foreach ($priorities as $key => $p) {
                if ($priority == $p) {
                    unset($priorities[$key]);
                }
            }
        }
        return view('admin.portfolio.create', compact('categories', 'priorities'));
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
            if (!$this->authorize('portfolio')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'categoryID_FK' => 'Integer',
            'slug' => 'required',
            'picture' => 'mimes:jpeg,bmp,png',
        ]);
        $mainTarget1 = "/upload/images/portfolio/large/";
        $othersTarget2 = "/upload/images/portfolio/small/";
        $pictures = $request['picture'];
        $status = 0;
        if (isset($request['status'])) {
            $status = 1;
        }
        if (!isset($request['categoryID_FK']) or $request['categoryID_FK'] == 0) {
            return back()->with('error', 'دسته بندی انتخاب نشده');
        }
        if (!isset($request['picture'])) {
            return
                back()->
                with('error', 'هیچ تصویری انتخاب نشده');
        }
        $mainPicture = $this->
        handleMainFile($pictures[0], $mainTarget1);

        $portfolio = Portfolio::create([
            'picture' => $mainPicture,
            'status' => $status,
            'title' => $request['title'],
            'slug' => $request['slug'],
            'tags' => $request['tags'],
            'content' => $request['content'],
            'priority' => $request['priority'],
            'categoryID_FK' => $request['categoryID_FK'],
            'usersID_FK' => auth()->user()->id,
        ]);
        if (count($pictures) > 1) {
            array_shift($pictures);
            $otherPictures = $this->
            handleArrayFiles($pictures, $othersTarget2);
            foreach ($otherPictures as $key => $item) {
                ImageModel::create([
                    'picture' => $item,
                    'symbol' => 'portfolio_' . $key,
                    'model_id' => $portfolio->id
                ]);
            }
        }
        return redirect()->route('portfolio.index')->with('message', 'عملیات موفقیت آمیز بود');;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        try {
            if (!$this->authorize('portfolio')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $categories = Vw_CategoryPortfolio::where(['status' => 1])->get();
        $priority_arr = Vw_Portfolio::where('priority', '!=', 0)->select(['priority'])->get();
        $otherImages = ImageModel::where('symbol', 'like', 'portfolio_%')->where(['model_id' => $portfolio->id])->get();
        $priorities = [1, 2, 3];
        $priority_ids = [];
        foreach ($priority_arr as $p) {
            array_push($priority_ids, $p->priority);
        }
        foreach ($priority_ids as $priority) {
            foreach ($priorities as $key => $p) {
                if ($priority == $p) {
                    unset($priorities[$key]);
                }
            }
        }
        return view('admin.portfolio.update', compact('categories', 'portfolio', 'priorities', 'otherImages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        try {
            if (!$this->authorize('portfolio')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'categoryID_FK' => 'Integer',
            'slug' => 'required',
            'mainPicture' => 'mimes:jpeg,bmp,png',
        ]);
        $status = 0;
        if (!isset($request['categoryID_FK']) or $request['categoryID_FK'] == 0) {
            return back()->with('error', 'دسته بندی انتخاب نشده');
        }
        if (isset($request['status'])) {
            $status = 1;
        }
        $priority = $portfolio->priority;
        if (isset($request['priority'])) {
            $priority = $request['priority'];
        }
        $mainPicture = $request->file('mainPicture');
        if (isset($mainPicture)) {
            $mainTarget1 = "/upload/images/portfolio/large/";
            $main = $portfolio->picture;
            $this->removeImage($main['main']);
            foreach ($main['others'] as $other) {
                $this->removeImage($other);
            }
            $mainPicture = $this->
            handleMainFile($mainPicture, $mainTarget1);
            $portfolio->update([
                'picture' => $mainPicture
            ]);
        }
        $othersTarget2 = "/upload/images/portfolio/small/";
        $otherImages = ImageModel::where('symbol', 'like', 'portfolio_%')->where(['model_id' => $portfolio->id])->get();
        foreach ($otherImages as $key => $otherImage) {
            $picture = $request->file($otherImage->symbol);
            if (isset($picture)) {
                $address = $this->handleOneImage($picture, $othersTarget2);
                $this->removeImage($otherImage->picture);
                $otherImage->update([
                    'picture' => $address
                ]);
            } else {
                if (!isset($request['text_' . $otherImage->symbol])) {
                    $this->removeImage($otherImage->picture);
                    $otherImage->delete();
                }
            }
        }
        $pictures = $request['picture'];
        if (isset($pictures)) {
            $otherPictures = $this->
            handleArrayFiles($pictures, $othersTarget2);
            $imageModels = ImageModel::where('symbol', 'like', 'portfolio_%')->where(['model_id' => $portfolio->id])->orderBy('symbol', 'desc')->first();
            if (isset($imageModels)) {
                $imageModelsItems = explode('_', $imageModels->symbol);
                $count = $imageModelsItems[1];
            } else {
                $count = 0;
            }
            foreach ($otherPictures as $item) {
                $count += 1;
                ImageModel::create([
                    'picture' => $item,
                    'symbol' => 'portfolio_' . $count,
                    'model_id' => $portfolio->id
                ]);
            }
        }
        $portfolio->update([
            'status' => $status,
            'title' => $request['title'],
            'slug' => $request['slug'],
            'tags' => $request['tags'],
            'content' => $request['content'],
            'priority' => $priority,
            'categoryID_FK' => $request['categoryID_FK'],
            'usersID_FK' => auth()->user()->id,
        ]);
        return redirect()->route('portfolio.index')->with('message', 'عملیات موفقیت آمیز بود');;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        try {
            if (!$this->authorize('portfolio')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $this->removeImageOfObject($portfolio);
        $portfolio->delete();
        return redirect(route('portfolio.index'))->with('message', 'عملیات موفقیت آمیز بود');
    }
}
