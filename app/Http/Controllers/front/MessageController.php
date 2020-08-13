<?php

namespace App\Http\Controllers\front;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $customer = Customer::where('email',$request['email'])->first();
        if (!isset($customer)){
            $customer = Customer::create([
                'name'=>$request['name'],
                'email'=>$request['email'],
            ]);
        }
        if ($request['contact']){
            if (isset($customer)){
                $contact = Message::where(['customer_id'=>$customer->id,'contact'=>1])->first();
                if (isset($contact)){
                    return back()->with('error','شما قبلا یک پیام ارسال کردید');
                }
                $subject = $request['subject'];
                Message::create([
                    'customer_id'=>$customer->id,
                    'subject'=>$subject,
                    'contact'=>1,
                    'content'=>$request['content'],
                ]);
            }
        }else if($request['comment']){
            if (isset($customer)){
                $comment = Message::where(['customer_id'=>$customer->id,'comment'=>1,'article_id'=>$request['article_id']])->first();
                if (isset($comment)){
                    return back()->with('error','شما قبلا یک پیام فرستادید در صورتی که جواب داده بشه میتوانید پیام دیگری بذارید');
                }
                $article_id = $request['article_id'];
                Message::create([
                    'article_id'=>$article_id,
                    'customer_id'=>$customer->id,
                    'comment'=>1,
                    'content'=>$request['content'],
                ]);
            }
        }
        return back()->with('message','پیام شما ثبت شد');
    }

    public function saveAnswer(Request $request)
    {
        $data = $request['data'];
        $message = $data['message'];
        $id = $data['message_id'];
        Message::find($id)->update([
           'answer'=> $message,
           'user_id'=> auth()->user()->id
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
