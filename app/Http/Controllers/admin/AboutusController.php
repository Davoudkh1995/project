<?php

namespace App\Http\Controllers\admin;

use App\Aboutus;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            if (!$this->authorize('about')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $aboutus = Aboutus::where('lang','fa')->first();
        return view('admin.aboutus.create',compact('aboutus'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aboutus  $aboutus
     * @return \Illuminate\Http\Response
     */
    public function show(Aboutus $aboutus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aboutus  $aboutus
     * @return \Illuminate\Http\Response
     */
    public function edit(Aboutus $aboutus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aboutus  $aboutus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aboutus $aboutus)
    {
        try {
            if (!$this->authorize('about')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'content' => 'required',
        ]);
        $item = Aboutus::where('lang','fa')->first();
        if (isset($item)){
            $item->update([
                'content'=>$request['content'],
            ]);
        }else{
            Aboutus::create([
                'usersID_FK'=>auth()->user()->id,
                'content'=>$request['content'],
            ]);
        }
        return back()->with('message','عملیات موفقیت آمیز بود');
    }

    public function showUpdateAboutEn()
    {
        try {
            if (!$this->authorize('about')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $aboutus = Aboutus::where('lang','en')->first();
        return view('admin.aboutus.createEn',compact('aboutus'));
    }

    public function updateAboutEn(Request $request, Aboutus $aboutus)
    {
        try {
            if (!$this->authorize('about')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'content' => 'required',
        ]);
        $item = Aboutus::where('lang','en')->first();
        if (isset($item)){
            $item->update([
                'content'=>$request['content'],
                'lang' => 'en',
            ]);
        }else{
            Aboutus::create([
                'usersID_FK'=>auth()->user()->id,
                'lang' => 'en',
                'content'=>$request['content'],
            ]);
        }
        return back()->with('message','عملیات موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aboutus  $aboutus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aboutus $aboutus)
    {
        //
    }
}
