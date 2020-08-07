<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Vw_CategoryArticles;
use App\Vw_CategoryPortfolio;
use App\Vw_CategoryServices;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use function Sodium\add;

class MainController extends Controller
{

    public function uploadFile($file,$target)
    {
        $now = time();
        $filename = $now . '_' . $file->getClientOriginalName();
        $fullpath = $target . $filename;
        $file->move(public_path($target), $filename);
        return $fullpath;
    }

    public function resizeImageUpload($file,$target,$width,$height)
    {
        $now = time();
        $filename = $now . '_' . $file->getClientOriginalName();
        $path = public_path($target. $filename) ;
        $fullpath = $target . $filename;
        Image::make($file)->resize($width, $height)->save($path);
        return $fullpath;
    }

    public function removeFile($path)
    {
        if ($path != "" or !is_null($path)) {
            $file = new \Illuminate\Http\File(public_path($path));
            if (file_exists($file)) {
                unlink($file);
                return true;
            }
        }
        return false;
    }



    protected function imageUploader($file, $target)
    {
        /* when uploading image into server use this */
        $filename = $file->getClientOriginalName();
        $filename = time().'_'.$filename;
        $file->move($target,$filename);
        return $target.$filename;
    }
    public function remove_move_file($file,$total_path,$target_path,$filename)
    {
        /* when removing image from server use this */
        if (file_exists($total_path)) {
            unlink($total_path);
        }
        $file->move($target_path, $filename);
    }


    public function handleMainFile($file, $baseTarget)
    {
        $picture = [];
        $filesystem = new Filesystem();
        $filename = $file->getClientOriginalName();

        if ($filesystem->exists(public_path($baseTarget).$filename)){
            $filename = time().'-'.$filename;
        }
        $target = $baseTarget.$filename;/*mainImage*/
        $otherImagesAddress = $this->handleResizeImage($file,$baseTarget);/*otherImages*/
        $file->move(public_path($baseTarget),$filename);
        $picture['main'] = $target;
        $picture['others'] = $otherImagesAddress;
        return $picture;
    }


    public function handleOneImage($file,$baseTarget)
    {
        $filename = time().'-'.$file->getClientOriginalName();
        $target = $baseTarget.$filename;
        $img = Image::make($file->path());
        $img->resize('600', 'auto', function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path($target));
        return $target;
    }

    public function handleResizeImage($file,$baseTarget)
    {
        $filename = time().'-'.$file->getClientOriginalName();
        $sizes = [300,600,900];
        $address = [];
        foreach ($sizes as $size){
            $target = $baseTarget.$size.'_'.$filename;
            /*نکته : فولدر های داده شده در این مسیر باید حتما از قبل ساخته شده باشن در غیر این صورت سیستم در این نقطه خطا میدهد*/
            $img = Image::make($file->path());
            $img->resize($size, 'auto', function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($target));
            array_push($address,$target);
        }
        return $address;
    }

    public function handleArrayFiles($array,$baseTarget)
    {
        $address = [];
        if (count($array)){
            foreach ($array as $key=>$file){
                $filename = time().'-'.$file->getClientOriginalName();
                $target = $baseTarget.$filename;
                $img = Image::make($file->path());
                $img->resize('600', 'auto', function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($target));
                array_push($address,$target);
            }
            return $address;
        }
        return false;
    }

    public function removeImage($total_path)
    {
        $path = substr($total_path,1);
        if (file_exists($path)) {
            unlink($path);
        }
    }

    public function updatePortfolioToNonCategory($category)
    {
        $non_category = Vw_CategoryPortfolio::where('title', 'دسته بندی نشده')->first();
        $portfolios = $category->portfolio;
        if (count($portfolios)) {
            foreach ($portfolios as $portfolio) {
                $portfolio->update([
                    'categoryID_FK' => $non_category->id
                ]);
            }
        }
    }
    public function updateServiceToNonCategory($category)
    {
        $non_category = Vw_CategoryServices::where('title', 'دسته بندی نشده')->first();
        $services = $category->service;
        if (count($services)) {
            foreach ($services as $service) {
                $service->update([
                    'categoryID_FK' => $non_category->id
                ]);
            }
        }
    }
    public function updateArticleToNonCategory($category)
    {
        $non_category = Vw_CategoryArticles::where('title', 'دسته بندی نشده')->first();
        $article = $category->article;
        if (count($article)) {
            foreach ($article as $article) {
                $article->update([
                    'categoryID_FK' => $non_category->id
                ]);
            }
        }
    }

    public function removeImageOfObject($object)
    {
        $picture = $object->picture;
        $main = $picture['main'];
        $others = $picture['others'];
        if (count($others)){
            foreach ($others as $other) {
                $this->removeImage($other);
            }
        }
        $this->removeImage($main);
    }
}
