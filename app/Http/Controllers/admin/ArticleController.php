<?php

namespace App\Http\Controllers\admin;

use App\Article;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Message;
use App\Vw_articles;
use App\Vw_CategoryArticles;
use Illuminate\Http\Request;
use function Sodium\add;

class ArticleController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Vw_articles::orderbyDesc('created_at')->get();
        return view('admin.article.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Vw_CategoryArticles::where(['status' => 1])->get();
        $priority_arr = Vw_articles::where('priority', '!=', 0)->select(['priority'])->get();
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
        return view('admin.article.create', compact('categories', 'priorities'));
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
        $popular = 0;
        if (isset($request['status'])) {
            $status = 1;
        }
        if (isset($request['popular'])) {
            $popular = 1;
        }
        $file = $request->file('picture');
        if (!isset($file)) {
            return back()->with('error','تصویر انتخاب نشده');
        }
        $mainTarget1 = "/upload/images/blog/";
        $mainPicture = $this->handleMainFile($file, $mainTarget1);
        $address = \Illuminate\Support\Facades\App::make('url')->to('/blog') . '/' . $request['slug'];
        Article::create([
            'picture' => $mainPicture,
            'url' => $address,
            'status' => $status,
            'popular' => $popular,
            'title' => $request['title'],
            'slug' => $request['slug'],
            'tags' => $request['tags'],
            'content' => $request['content'],
            'priority' => $request['priority'],
            'categoryID_FK' => $request['categoryID_FK'],
            'usersID_FK' => auth()->user()->id,
        ]);
        return redirect(route('article.index'))->with('message','عملیات موفقیت آمیز بود');;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Vw_CategoryArticles::where(['status' => 1])->get();
        $priority_arr = Vw_articles::where('priority', '!=', 0)->select(['priority'])->get();
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

        $messages = Message::where('article_id',$article->id)->Where(function ($query){
            $query->whereNull('answer')->orWhere('answer','=','');
        })->get();
        foreach ($messages as $message){
            $message['customerName'] = Customer::find($message->customer_id)->name;
        }
        return view('admin.article.update', compact('categories', 'article', 'priorities','messages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $status = 0;
        if (isset($request['status'])) {
            $status = 1;
        }
        $popular = 0;
        if (isset($request['popular'])) {
            $popular = 1;
        }
        $mainPicture = $request->file('picture');
        if (isset($mainPicture)){
            $mainTarget1 = "/upload/images/blog/";
            $main = $article->picture;
            $this->removeImage($main['main']);
            foreach ($main['others'] as $other){
                $this->removeImage($other);
            }
            $mainPicture = $this->
            handleMainFile($mainPicture, $mainTarget1);
            $article->update([
                'picture' => $mainPicture
            ]);
        }
        $priority = $article->priority;
        if (isset($request['priority'])) {
            $priority = $request['priority'];
        }
        $address = \Illuminate\Support\Facades\App::make('url')->to('/blog') . '/' . $request['slug'];
        $article->update([
            'url' => $address,
            'status' => $status,
            'popular' => $popular,
            'title' => $request['title'],
            'slug' => $request['slug'],
            'tags' => $request['tags'],
            'content' => $request['content'],
            'priority' => $priority,
            'categoryID_FK' => $request['categoryID_FK'],
        ]);
        return redirect(route('article.index'))->with('message','عملیات موفقیت آمیز بود');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->removeImageOfObject($article);
        $article->delete();
        return redirect(route('article.index'))->with('message','عملیات موفقیت آمیز بود');
    }
}
