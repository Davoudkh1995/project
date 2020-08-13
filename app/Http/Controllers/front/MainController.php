<?php

namespace App\Http\Controllers\front;

use App\Aboutus;
use App\Article;
use App\Contactus;
use App\Customer;
use App\Http\Controllers\Controller;
use App\ImageModel;
use App\Message;
use App\Portfolio;
use App\Slider;
use App\User;
use App\Vw_articles;
use App\Vw_CategoryArticles;
use App\Vw_CategoryPortfolio;
use App\Vw_Portfolio;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class MainController extends Controller
{
    private $locale;

    public function index()
    {
        $this->locale = app()->getLocale();
        $sliders = Slider::where('lang',$this->locale)->where(['status' => 1])->select(['picture', 'title'])->orderBy('priority', 'asc')->take(5)->get();
        $portfolios = Portfolio::where('lang',$this->locale)->orderbyDesc('priority')->take(7)->get();

        return view('front.index', compact('sliders', 'portfolios'));
    }

    public function contact()
    {
        $this->locale = app()->getLocale();
        $data = Contactus::where('lang',$this->locale)->first();
        return view('front.contact', compact('data'));
    }

    public function about()
    {
        $this->locale = app()->getLocale();
        $about = Aboutus::where('lang',$this->locale)->first();
        return view('front.about', compact('about'));
    }

    public function portfolios()
    {
        $this->locale = app()->getLocale();
        $categories = Vw_CategoryPortfolio::where('lang',$this->locale)->where('status', 1)->orderByDesc('id')->get();
        foreach ($categories as $category) {
            $portfolios = Vw_Portfolio::where('lang',$this->locale)->where(['status' => 1, 'categoryID_FK' => $category->id])->get();
            $category['portfolios'] = $portfolios;
        }
        return view('front.portfolio.archive', compact('categories'));
    }

    public function portfolioDetails($slug)
    {
        $this->locale = app()->getLocale();
        $portfolio = Vw_Portfolio::where('lang',$this->locale)->where(['slug' => $slug])->first();
        $portfolioImages = ImageModel::where('symbol', 'like', 'portfolio_%')->where('model_id', $portfolio->id)->get();
        $relatedPortfolios = Vw_Portfolio::where('lang',$this->locale)->where(['categoryID_FK' => $portfolio->categoryID_FK])->get();
        foreach ($relatedPortfolios as $key => $relatedPortfolio) {
            if ($relatedPortfolio->id == $portfolio->id) {
                unset($relatedPortfolios[$key]);
            }
        }
        $portfolio['tags'] = explode(',',$portfolio->tags);
        return view('front.portfolio.details', compact('portfolio', 'portfolioImages', 'relatedPortfolios'));
    }

    public function articles()
    {
        $this->locale = app()->getLocale();
        $categories = Vw_CategoryArticles::where('lang',$this->locale)->where('status', 1)->orderByDesc('id')->get();
        $articles = Vw_articles::where('lang',$this->locale)->where(['status' => 1])->orderByDesc('id')->paginate(3);
        foreach ($articles as $article){
            $article['message_count'] = Message::where('article_id',$article->id)->get()->count();
        }
        $articles = $this->handleDateAndUserForArray($articles);
        $latestArticles = Vw_articles::where('lang',$this->locale)->where(['status' => 1])->orderByDesc('created_at')->take(3)->get();
        $latestArticles = $this->handleDateAndUserForArray($latestArticles);
        $popularArticles = Vw_articles::where('lang',$this->locale)->where(['status' => 1, 'popular' => 1])->orderByDesc('created_at')->take(3)->get();
        $popularArticles = $this->handleDateAndUserForArray($popularArticles);
        return view('front.article.archive', compact('categories', 'articles', 'latestArticles', 'popularArticles'));
    }

    public function articleDetails($slug)
    {
        $this->locale = app()->getLocale();
        $article = Vw_articles::where('lang',$this->locale)->where(['slug' => $slug])->first();
        $result = $this->handleBeforeAfterArticle($article->id);
        $beforeBool = $result[0];
        $afterBool = $result[1];
        $beforeSlug = $result[2];
        $afterSlug = $result[3];
        $article = $this->handleDateAndUserForObject($article);
        $categories = Vw_CategoryArticles::where('lang',$this->locale)->where('status', 1)->orderByDesc('id')->get();
        $latestArticles = Vw_articles::where('lang',$this->locale)->where(['status' => 1])->orderByDesc('created_at')->take(3)->get();
        $latestArticles = $this->handleDateAndUserForArray($latestArticles);
        $popularArticles = Vw_articles::where('lang',$this->locale)->where(['status' => 1, 'popular' => 1])->orderByDesc('created_at')->take(3)->get();
        $popularArticles = $this->handleDateAndUserForArray($popularArticles);
        $tags = $article->tags;
        if (strlen($tags)){
            $tags =  explode(',',$tags);
        }
        $messages = Message::where('article_id',$article->id)->get();
        foreach ($messages as $message){
            $user = User::find($message->user_id);
            if (isset($user)){
                $message['admin'] = $user->name;
            }
            $message['customer'] = Customer::find($message->customer_id)->name;
            $v = new Verta($message->created_at);
            $message['date'] = $v->format('Y/n/j');
        }
        $article['message_count'] = Message::where('article_id',$article->id)->get()->count();
        return view('front.article.details', compact('article','popularArticles','latestArticles','categories','tags','messages','afterBool','beforeBool','afterSlug','beforeSlug'));
    }

    public function beforeArticle($slug)
    {
        $this->locale = app()->getLocale();
        $article = Vw_articles::where('lang',$this->locale)->where('slug',$slug)->first();
        $result = $this->handleBeforeAfterArticle($article->id);
        $beforeBool = $result[0];
        $afterBool = $result[1];
        $beforeSlug = $result[2];
        $afterSlug = $result[3];
        $article = $this->handleDateAndUserForObject($article);
        $categories = Vw_CategoryArticles::where('lang',$this->locale)->where('status', 1)->orderByDesc('id')->get();
        $latestArticles = Vw_articles::where('lang',$this->locale)->where(['status' => 1])->orderByDesc('created_at')->take(3)->get();
        $latestArticles = $this->handleDateAndUserForArray($latestArticles);
        $popularArticles = Vw_articles::where('lang',$this->locale)->where(['status' => 1, 'popular' => 1])->orderByDesc('created_at')->take(3)->get();
        $popularArticles = $this->handleDateAndUserForArray($popularArticles);
        $tags = $article->tags;
        if (strlen($tags)){
            $tags =  explode(',',$tags);
        }
        $messages = Message::where('article_id',$article->id)->get();
        foreach ($messages as $message){
            $user = User::find($message->user_id);
            if (isset($user)){
                $message['admin'] = $user->name;
            }
            $message['customer'] = Customer::find($message->customer_id)->name;
            $v = new Verta($message->created_at);
            $message['date'] = $v->format('Y/n/j');
        }
        return view('front.article.details', compact('article','popularArticles','latestArticles','categories','tags','messages','afterBool','beforeBool','afterSlug','beforeSlug'));
    }

    public function afterArticle($slug)
    {
        $this->locale = app()->getLocale();
        $article = Vw_articles::where('lang',$this->locale)->where('slug',$slug)->first();
        $result = $this->handleBeforeAfterArticle($article->id);
        $beforeBool = $result[0];
        $afterBool = $result[1];
        $beforeSlug = $result[2];
        $afterSlug = $result[3];
        $article = $this->handleDateAndUserForObject($article);
        $categories = Vw_CategoryArticles::where('lang',$this->locale)->where('status', 1)->orderByDesc('id')->get();
        $latestArticles = Vw_articles::where('lang',$this->locale)->where(['status' => 1])->orderByDesc('created_at')->take(3)->get();
        $latestArticles = $this->handleDateAndUserForArray($latestArticles);
        $popularArticles = Vw_articles::where('lang',$this->locale)->where(['status' => 1, 'popular' => 1])->orderByDesc('created_at')->take(3)->get();
        $popularArticles = $this->handleDateAndUserForArray($popularArticles);
        $tags = $article->tags;
        if (strlen($tags)){
            $tags =  explode(',',$tags);
        }
        $messages = Message::where('article_id',$article->id)->get();
        foreach ($messages as $message){
            $user = User::find($message->user_id);
            if (isset($user)){
                $message['admin'] = $user->name;
            }
            $message['customer'] = Customer::find($message->customer_id)->name;
            $v = new Verta($message->created_at);
            $message['date'] = $v->format('Y/n/j');
        }
        return view('front.article.details', compact('article','popularArticles','latestArticles','categories','tags','messages','afterBool','beforeBool','afterSlug','beforeSlug'));
    }

    public function handleBeforeAfterArticle($articleID)
    {
        $this->locale = app()->getLocale();
        $before = Vw_articles::where('lang',$this->locale)->where('id','<',$articleID)->orderByDesc('id')->first();
        $after = Vw_articles::where('lang',$this->locale)->where('id','>',$articleID)->orderBy('id','asc')->first();
        $afterBool = false;
        $afterSlug = '';
        $beforeBool = false;
        $beforeSlug = '';
        if (isset($before)){
            $beforeBool = true;
            $beforeSlug = $before->slug;
        }
        if (isset($after)){
            $afterBool = true;
            $afterSlug = $after->slug;
        }
        return [$beforeBool,$afterBool,$beforeSlug,$afterSlug];
    }

    public function articleCategoryArchive($slug)
    {
        $this->locale = app()->getLocale();
        $category = Vw_CategoryArticles::where('lang',$this->locale)->where('title',$slug )->first();
        $articles = Vw_articles::where('lang',$this->locale)->where(['categoryID_FK' => $category->id])->paginate(5);
        $categories = Vw_CategoryArticles::where('lang',$this->locale)->where('status', 1)->orderByDesc('id')->get();
        $latestArticles = Vw_articles::where('lang',$this->locale)->where(['status' => 1])->orderByDesc('created_at')->take(3)->get();
        $latestArticles = $this->handleDateAndUserForArray($latestArticles);
        $popularArticles = Vw_articles::where('lang',$this->locale)->where(['status' => 1, 'popular' => 1])->orderByDesc('created_at')->take(3)->get();
        $popularArticles = $this->handleDateAndUserForArray($popularArticles);
        $tags = explode(',',$category->tags);
        return view('front.article.archive', compact('articles','popularArticles','latestArticles','categories','tags'));
    }

    public function articlesSearch(Request $request)
    {
        $this->locale = app()->getLocale();
        if (empty($request['slug'])) {
            return redirect()->to('/article')->with('error', 'هیچ موردی نوشته نشد');
        }
        $articles = Vw_articles::where('lang',$this->locale)->where('title', 'like', '%' . $request['slug'] . '%')->paginate(5);
        $articles = $this->handleDateAndUserForArray($articles);
        $categories = Vw_CategoryArticles::where('lang',$this->locale)->where('status', 1)->orderByDesc('id')->get();
        $latestArticles = Vw_articles::where('lang',$this->locale)->where(['status' => 1])->orderByDesc('created_at')->take(3)->get();
        $latestArticles = $this->handleDateAndUserForArray($latestArticles);
        $popularArticles = Vw_articles::where('lang',$this->locale)->where(['status' => 1, 'popular' => 1])->orderByDesc('created_at')->take(3)->get();
        $popularArticles = $this->handleDateAndUserForArray($popularArticles);
        return view('front.article.archive', compact('categories', 'articles', 'latestArticles', 'popularArticles'));
    }

    public function handleDateAndUserForObject($object)
    {
        $object['user'] = User::find($object->usersID_FK)->name;
        $v = new Verta($object->created_at);
        $object['date'] = $v->format('%B %d');
        return $object;
    }

    public function handleDateAndUserForArray($objects)
    {
        foreach ($objects as $object) {
            $object['user'] = User::find($object->usersID_FK)->name;
            $v = new Verta($object->created_at);
            $object['date'] = $v->format('%B %d');
        }
        return $objects;
    }

    public function changeLanguage($lang)
    {
        /*$locale = request()->segment(1);
        if (!array_key_exists($locale, config('app.locales'))){
            $segments = request()->segments();
            $segments[0] =  config('app.fallback_locale');
            return redirect(implode('/',$segments));
        }*/
        $segment = \request()->segment(count(\request()->segments()));
        if (array_key_exists($segment, config('app.locales'))){
            if ($segment == 'en'){
                app()->setLocale('en');
                return redirect('/'.'en');
            }
        }
        return redirect('/');
    }

}
