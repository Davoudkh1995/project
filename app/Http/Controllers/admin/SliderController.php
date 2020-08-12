<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Slider;
use App\Vw_Sliders;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use MicrosoftAzure\Storage\File\Models\File;

class SliderController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (!$this->authorize('slider')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }
        $items = Vw_Sliders::orderbyDesc('created_at')->get();
        return view('admin.slider.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            if (!$this->authorize('slider')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $priorities = $this->handleSliderPriorities();
        return view('admin.slider.create', compact('priorities'));
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
            if (!$this->authorize('slider')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'picture' => 'required|mimes:jpeg,bmp,png',
        ]);
        $status = 0;
        if (isset($request['status'])) {
            $status = 1;
        }
        $sliders = Slider::where(['slider_type' => $request['slider_type']])->select(['id'])->get();
        if (count($sliders) < 5) {
            $target = '/upload/images/slider/';
            $fullpath = $this->uploadFile($request->file('picture'), $target);
            Slider::create([
                'picture' => $fullpath,
                'usersID_FK' => auth()->user()->id,
                'slider_type' => $request['slider_type'],
                'title' => $request['title'],
                'lang' => $request['lang'],
                'link' => $request['link'],
                'description' => $request['description'],
                'priority' => $request['priority'],
                'status' => $status,
            ]);
        }else{
            return redirect(route('slider.index'))->with('error', 'تعداد اسلایدر ها بیش از 5 است');
        }
        return redirect(route('slider.index'))->with('message', 'عملیات موفقیت آمیز بود');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        try {
            if (!$this->authorize('slider')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }
        $priorities = $this->handleSliderPriorities();
        return view('admin.slider.update', compact('slider', 'priorities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        try {
            if (!$this->authorize('slider')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'picture' => 'mimes:jpeg,bmp,png',
        ]);
        $status = 0;
        if (isset($request['status'])) {
            $status = 1;
        }
        $priority = $slider->priority;
        if (isset($request['priority'])) {
            $priority = $request['priority'];
        }
        $sliders = Slider::where(['slider_type' => $request['slider_type']])->select(['id'])->get();
        if (count($sliders) < 5) {
            $file = $request->file('picture');
            if (isset($file)) {
                $target = '/upload/images/slider/';
                $this->removeFile($slider->picture);
                $fullpath = $this->uploadFile($file, $target);
                $slider->update([
                    'picture' => $fullpath,
                ]);
            }
            $slider->update([
                'slider_type' => $request['slider_type'],
                'title' => $request['title'],
                'lang' => $request['lang'],
                'link' => $request['link'],
                'description' => $request['description'],
                'priority' => $priority,
                'status' => $status,
            ]);
        }else{
            return redirect(route('slider.index'))->with('error', 'تعداد اسلایدر ها بیش از 5 است');
        }
        return redirect(route('slider.index'))->with('message', 'عملیات موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        try {
            if (!$this->authorize('slider')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $this->removeFile($slider->picture);
        $slider->delete();
        return redirect(route('slider.index'))->with('message', 'عملیات موفقیت آمیز بود');
    }

    /*public function file_upload(Request $request)
    {
        $sliders = Slider::where(['slider_type'=>1])->select(['id'])->get();
        if (count($sliders) < 5){
        $now = time();
        $file = $request->file('file');
        $filename = $now.'_'.$file->getClientOriginalName();
        $target = '/images/slider/';
        $fullpath = $target . $filename;
        $file->move(public_path($target),$filename);
//        slider type => 0 text slider 1 only image slider
            Slider::create([
                'picture'=>$fullpath,
                'usersID_FK'=>auth()->user()->id,
                'slider_type'=>1
            ]);
        }
    }*/

    /*public function show_total_slider()
    {
        $pictures = Slider::where(['slider_type'=>1])->get();
        return view('admin.slider.total_update',compact('pictures'));
    }*/
}
