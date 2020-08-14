<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\ImageModel;
use App\Service;
use App\Vw_CategoryServices;
use App\Vw_Services;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

class ServiceController extends MainController
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

        $items = Vw_Services::orderbyDesc('created_at')->get();
        return view('admin.service.index', compact('items'));
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

        $categories = Vw_CategoryServices::where(['status' => 1])->get();
        $priority_arr = Vw_Services::where('priority', '!=', 0)->select(['priority'])->get();
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
        return view('admin.service.create', compact('categories', 'priorities'));
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
            'categoryID_FK' => 'Integer',
            'slug' => 'required',
        ]);
        $mainTarget1 = "/upload/images/service/large/";
        $othersTarget2 = "/upload/images/service/small/";
        $pictures = $request['picture'];
        $status = 0;
        if (isset($request['status'])) {
            $status = 1;
        }
        if (!isset($request['categoryID_FK']) or $request['categoryID_FK'] == 0) {
            return back()->with('error', 'دسته بندی انتخاب نشده');
        }
        if (!count($pictures)) {
            return
                back()->
                with('error', 'هیچ تصویری انتخاب نشده');
        }
        $mainPicture = $this->
        handleMainFile($pictures[0], $mainTarget1);

        $service = Service::create([
            'picture' => $mainPicture,
            'status' => $status,
            'title' => $request['title'],
            'slug' => $request['slug'],
            'tags' => $request['tags'],
            'content' => $request['content'],
            'priority' => $request['priority'],
            'lang' => $request['lang'],
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
                    'symbol' => 'service_' . $key,
                    'model_id' => $service->id
                ]);
            }
        }
        return redirect()->route('service.index')->with('message', 'عملیات موفقیت آمیز بود');;
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Service $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Service $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        try {
            if (!$this->authorize('service')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $categories = Vw_CategoryServices::where(['status' => 1])->get();
        $priority_arr = Vw_Services::where('priority', '!=', 0)->select(['priority'])->get();
        $otherImages = ImageModel::where('symbol', 'like', 'service_%')->where(['model_id' => $service->id])->get();
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
        return view('admin.service.update', compact('categories', 'service', 'priorities', 'otherImages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Service $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
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
            'categoryID_FK' => 'Integer',
            'slug' => 'required',
        ]);
        $status = 0;
        if (!isset($request['categoryID_FK']) or $request['categoryID_FK'] == 0) {
            return back()->with('error', 'دسته بندی انتخاب نشده');
        }
        if (isset($request['status'])) {
            $status = 1;
        }
        $priority = $service->priority;
        if (isset($request['priority'])) {
            $priority = $request['priority'];
        }
        $mainPicture = $request->file('mainPicture');
        if (isset($mainPicture)) {
            $mainTarget1 = "/upload/images/service/large/";
            $main = $service->picture;
            $this->removeImage($main['main']);
            foreach ($main['others'] as $other) {
                $this->removeImage($other);
            }
            $mainPicture = $this->
            handleMainFile($mainPicture, $mainTarget1);
            $service->update([
                'picture' => $mainPicture
            ]);
        }
        $othersTarget2 = "/upload/images/service/small/";
        $otherImages = ImageModel::where('symbol', 'like', 'service_%')->where(['model_id' => $service->id])->get();
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
            $imageModels = ImageModel::where('symbol', 'like', 'service_%')->where(['model_id' => $service->id])->orderBy('symbol', 'desc')->first();
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
                    'symbol' => 'service_' . $count,
                    'model_id' => $service->id
                ]);
            }
        }
        $service->update([
            'status' => $status,
            'title' => $request['title'],
            'slug' => $request['slug'],
            'tags' => $request['tags'],
            'content' => $request['content'],
            'priority' => $priority,
            'lang' => $request['lang'],
            'categoryID_FK' => $request['categoryID_FK'],
            'usersID_FK' => auth()->user()->id,
        ]);
        return redirect()->route('service.index')->with('message', 'عملیات موفقیت آمیز بود');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Service $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        try {
            if (!$this->authorize('service')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $this->removeImageOfObject($service);
        $service->delete();
        return redirect(route('service.index'))->with('message', 'عملیات موفقیت آمیز بود');;
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
            $service = Service::find($id);
            $this->removeImageOfObject($service);
            $service->delete();
        }
        return redirect(route('service.index'))->with('message', 'عملیات موفقیت آمیز بود');
    }
}
