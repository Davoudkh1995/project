<?php

namespace App\Http\Controllers\admin;

use App\Contactus;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            if (!$this->authorize('contact')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $contactus = Contactus::where('lang','fa')->first();
        $seo = $contactus->seo;
        return view('admin.contactus.create',compact('contactus','seo'));
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
     * @param  \App\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function show(Contactus $contactus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function edit(Contactus $contactus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contactus $contactus)
    {
        try {
            if (!$this->authorize('contact')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'address' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);
        $item = Contactus::where('lang','fa')->first();
        if (isset($item)){
            $item->update([
                'google_map'=>$request['google_map'],
                'address'=>$request['address'],
                'postal_code'=>$request['postal_code'],
                'fax'=>$request['fax'],
                'lang' => $request['lang'],
                'mobile'=>$request['mobile'],
                'email'=>$request['email'],
                'tel'=>$request['tel'],
            ]);
        }else{
            Contactus::create([
                'usersID_FK'=>auth()->user()->id,
                'google_map'=>$request['google_map'],
                'address'=>$request['address'],
                'postal_code'=>$request['postal_code'],
                'fax'=>$request['fax'],
                'mobile'=>$request['mobile'],
                'email'=>$request['email'],
                'tel'=>$request['tel'],
            ]);
        }
        return back()->with('message','عملیات موفقیت آمیز بود');
    }

    public function showUpdateContactEn()
    {
        try {
            if (!$this->authorize('contact')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $contactus = Contactus::where('lang','en')->first();
        $seo = $contactus->seo;
        return view('admin.contactus.createEn',compact('contactus','seo'));
    }

    public function updateContactEn(Request $request, Contactus $contactus)
    {
        try {
            if (!$this->authorize('contact')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'address' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);
        $item = Contactus::where('lang','en')->first();
        if (isset($item)){
            $item->update([
                'google_map'=>$request['google_map'],
                'address'=>$request['address'],
                'postal_code'=>$request['postal_code'],
                'fax'=>$request['fax'],
                'mobile'=>$request['mobile'],
                'email'=>$request['email'],
                'tel'=>$request['tel'],
            ]);
        }else{
            Contactus::create([
                'usersID_FK'=>auth()->user()->id,
                'google_map'=>$request['google_map'],
                'address'=>$request['address'],
                'postal_code'=>$request['postal_code'],
                'fax'=>$request['fax'],
                'lang' => 'en',
                'mobile'=>$request['mobile'],
                'email'=>$request['email'],
                'tel'=>$request['tel'],
            ]);
        }
        return back()->with('message','عملیات موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contactus $contactus)
    {
        //
    }

    public function save_seo_contact(Request $request)
    {
        $id = $request['object'];
        $item = Contactus::find($id);
        $seo = Seo::find($item->seo_id);
        if (isset($object)) {
            $index = 0;
            $follow = 0;
            if (isset($request['index'])) {$index = 1;}
            if (isset($request['follow'])) {$follow = 1;}
            $seo->update([
                'index'=>$index,
                'follow'=>$follow,
                'title'=>$request['title'],
                'description'=>$request['description'],
                'keywords'=>$request['keywords'],
                'seo_url'=>$request['seo_url'],
                'canonical'=>$request['canonical'],
            ]);
        } else {
            $index = 0;
            $follow = 0;
            if (isset($request['index'])) {$index = 1;}
            if (isset($request['follow'])) {$follow = 1;}
            $seo = Seo::create([
                'index'=>$index,
                'follow'=>$follow,
                'title'=>$request['title'],
                'description'=>$request['description'],
                'keywords'=>$request['keywords'],
                'seo_url'=>$request['seo_url'],
                'canonical'=>$request['canonical'],
            ]);
        }
        $item->update([
            'seo_id'=> $seo->id
        ]);
        return back()->with('massage', 'تغییرات صورت گرفت');
    }

    public function save_seo_contactEn(Request $request)
    {
        $id = $request['object'];
        $item = Contactus::find($id);
        $seo = Seo::find($item->seo_id);
        if (isset($object)) {
            $index = 0;
            $follow = 0;
            if (isset($request['index'])) {$index = 1;}
            if (isset($request['follow'])) {$follow = 1;}
            $seo->update([
                'index'=>$index,
                'follow'=>$follow,
                'title'=>$request['title'],
                'description'=>$request['description'],
                'keywords'=>$request['keywords'],
                'seo_url'=>$request['seo_url'],
                'canonical'=>$request['canonical'],
            ]);
        } else {
            $index = 0;
            $follow = 0;
            if (isset($request['index'])) {$index = 1;}
            if (isset($request['follow'])) {$follow = 1;}
            $seo = Seo::create([
                'index'=>$index,
                'follow'=>$follow,
                'title'=>$request['title'],
                'description'=>$request['description'],
                'keywords'=>$request['keywords'],
                'seo_url'=>$request['seo_url'],
                'canonical'=>$request['canonical'],
            ]);
        }
        $item->update([
            'seo_id'=> $seo->id
        ]);
        return back()->with('massage', 'تغییرات صورت گرفت');
    }
}
