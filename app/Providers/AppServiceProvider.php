<?php

namespace App\Providers;

use App\Article;
use App\Contactus;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Validator;
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
            $locale = app()->getLocale();
            $contact = Contactus::where('lang', $locale)->first();
            $articles = Article::where('lang', $locale)->where('status', 1)->orderBy('priority', 'asc')->take(3)->get();
            foreach ($articles as $article) {
                $time = new Verta($article->created_at);
                $article['date'] = $time->format('Y/n/j');
            }
            $latestBlog = Article::where('lang', $locale)->where(['status' => 1])->orderByDesc('id')->first();
            $view->with(compact('contact', 'articles', 'latestBlog'));
        });
    }
}
