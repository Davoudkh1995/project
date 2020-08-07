<?php

namespace App\Http\Controllers\front;

use App\Aboutus;
use App\Article;
use App\Contactus;
use App\Http\Controllers\Controller;
use App\ImageModel;
use App\Portfolio;
use App\Slider;
use App\User;
use App\Vw_articles;
use App\Vw_CategoryArticles;
use App\Vw_CategoryPortfolio;
use App\Vw_Portfolio;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        $sliders = Slider::where(['status' => 1])->select(['picture', 'title'])->orderBy('priority', 'asc')->take(5)->get();
        $portfolios = Portfolio::orderbyDesc('priority')->take(7)->get();

        return view('front.index', compact('sliders', 'portfolios'));
    }

    public function contact()
    {
        $data = Contactus::first();
        return view('front.contact', compact('data'));
    }

    public function about()
    {
        $about = Aboutus::first();
        return view('front.about', compact('about'));
    }

    public function portfolios()
    {
        $categories = Vw_CategoryPortfolio::where('status', 1)->orderByDesc('id')->get();
        foreach ($categories as $category) {
            $portfolios = Vw_Portfolio::where(['status' => 1, 'categoryID_FK' => $category->id])->get();
            $category['portfolios'] = $portfolios;
        }
        return view('front.portfolio.archive', compact('categories'));
    }

    public function portfolioDetails($slug)
    {
        $portfolio = Vw_Portfolio::where(['slug' => $slug])->first();
        $portfolioImages = ImageModel::where('symbol', 'like', 'portfolio_%')->where('model_id', $portfolio->id)->get();
        $relatedPortfolios = Vw_Portfolio::where(['categoryID_FK' => $portfolio->categoryID_FK])->get();
        foreach ($relatedPortfolios as $key => $relatedPortfolio) {
            if ($relatedPortfolio->id == $portfolio->id) {
                unset($relatedPortfolios[$key]);
            }
        }
        return view('front.portfolio.details', compact('portfolio', 'portfolioImages', 'relatedPortfolios'));
    }

    public function articles()
    {
        $categories = Vw_CategoryArticles::where('status', 1)->orderByDesc('id')->get();
        $articles = Vw_articles::where(['status' => 1])->paginate(5);
        $articles = $this->handleDateAndUserForArray($articles);
        $latestArticles = Vw_articles::where(['status' => 1])->orderByDesc('created_at')->take(3)->get();
        $latestArticles = $this->handleDateAndUserForArray($latestArticles);
        $popularArticles = Vw_articles::where(['status' => 1, 'popular' => 1])->orderByDesc('created_at')->take(3)->get();
        $popularArticles = $this->handleDateAndUserForArray($popularArticles);
        return view('front.article.archive', compact('categories', 'articles', 'latestArticles', 'popularArticles'));
    }

    public function articleDetails($slug)
    {
        $article = Vw_articles::where(['slug' => $slug])->first();
        $article = $this->handleDateAndUserForObject($article);
        $categories = Vw_CategoryArticles::where('status', 1)->orderByDesc('id')->get();
        $latestArticles = Vw_articles::where(['status' => 1])->orderByDesc('created_at')->take(3)->get();
        $latestArticles = $this->handleDateAndUserForArray($latestArticles);
        $popularArticles = Vw_articles::where(['status' => 1, 'popular' => 1])->orderByDesc('created_at')->take(3)->get();
        $popularArticles = $this->handleDateAndUserForArray($popularArticles);
        $tags = $article->tags;
        if (strlen($tags)){
            $tags =  explode(',',$tags);
        }
        return view('front.article.details', compact('article','popularArticles','latestArticles','categories','tags'));
    }

    public function articleCategoryArchive($slug)
    {
        $category = Vw_CategoryArticles::where('title',$slug )->first();
        $articles = Vw_articles::where(['categoryID_FK' => $category->id])->paginate(5);
        $categories = Vw_CategoryArticles::where('status', 1)->orderByDesc('id')->get();
        $latestArticles = Vw_articles::where(['status' => 1])->orderByDesc('created_at')->take(3)->get();
        $latestArticles = $this->handleDateAndUserForArray($latestArticles);
        $popularArticles = Vw_articles::where(['status' => 1, 'popular' => 1])->orderByDesc('created_at')->take(3)->get();
        $popularArticles = $this->handleDateAndUserForArray($popularArticles);
        $tags = explode(',',$category->tags);
        return view('front.article.archive', compact('articles','popularArticles','latestArticles','categories','tags'));
    }

    public function articlesSearch(Request $request)
    {
        if (empty($request['slug'])) {
            return redirect()->to('/article')->with('error', 'هیچ موردی نوشته نشد');
        }
        $articles = Vw_articles::where('title', 'like', '%' . $request['slug'] . '%')->paginate(5);
        $articles = $this->handleDateAndUserForArray($articles);
        $categories = Vw_CategoryArticles::where('status', 1)->orderByDesc('id')->get();
        $latestArticles = Vw_articles::where(['status' => 1])->orderByDesc('created_at')->take(3)->get();
        $latestArticles = $this->handleDateAndUserForArray($latestArticles);
        $popularArticles = Vw_articles::where(['status' => 1, 'popular' => 1])->orderByDesc('created_at')->take(3)->get();
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


}
