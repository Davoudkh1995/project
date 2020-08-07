<?php

namespace App\Providers;

use App\Article;
use App\Contactus;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('front.master.index', function ($view) {

            $contact = Contactus::first();
            $articles = Article::where('status',1)->orderBy('priority','asc')->take(3)->get();
            foreach ($articles as $article){
                $time = new Verta($article->created_at);
                $article['date'] = $time->format('Y/n/j');
            }
            $latestBlog = Article::where(['status'=>1])->orderByDesc('id')->first();
//            dd($latestBlog);
            $view->with(compact('contact','articles','latestBlog'));
        });
    }
}
