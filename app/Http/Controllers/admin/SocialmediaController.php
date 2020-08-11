<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Socialmedia;
use App\Vw_Socialmedia;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class SocialmediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (!$this->authorize('socialmedia')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $type_arr = Vw_Socialmedia::where('type','!=',0)->select(['type'])->get();
        $types = [1,2,3,4,5,6,7,8];
        $types_ids = [];
        foreach ($type_arr as $p){
            array_push($types_ids,$p->type);
        }
        foreach ($types_ids as $type){
            foreach ($types as $key=>$p){
                if ($type == $p){
                    unset($types[$key]);
                }
            }
        }
        $items = Vw_Socialmedia::all();
        return view('admin.socialmedia.create',compact('items','types'));
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
        try {
            if (!$this->authorize('socialmedia')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $request->validate([
            'type' => 'Integer',
        ]);
        Socialmedia::create([
            'link'=>$request['link'],
            'type'=>$request['type']
        ]);
        return redirect(route('socialmedia.index'))->with('message','عملیات موفقیت آمیز بود');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Socialmedia  $socialmedia
     * @return \Illuminate\Http\Response
     */
    public function show(Socialmedia $socialmedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Socialmedia  $socialmedia
     * @return \Illuminate\Http\Response
     */
    public function edit(Socialmedia $socialmedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Socialmedia  $socialmedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Socialmedia $socialmedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Socialmedia  $socialmedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Socialmedia $socialmedia)
    {
        //
    }

    public function getSocialmediaItem(Request $request)
    {
        try {
            if (!$this->authorize('socialmedia')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $item = Socialmedia::find($request['id']);
        return response()->json(['link'=>$item->link,'id'=>$item->id]);
    }

    public function saveSocialChange(Request $request)
    {
        try {
            if (!$this->authorize('socialmedia')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $item = Socialmedia::find($request['item_id']);
        $item->update([
           'link'=>$request['link']
        ]);
        return back();
    }

    public function changeSocialStatus(Request $request)
    {
        try {
            if (!$this->authorize('socialmedia')) {
                abort(403);
            }
        } catch (AuthorizationException $e) {
            abort(403);
        }

        $item = Socialmedia::find($request['id']);

        $item->update([
            'status'=>!$item->status
        ]);
        return response(['done'=>'done']);
    }
}
