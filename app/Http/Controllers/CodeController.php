<?php

namespace App\Http\Controllers;

use App\Code;
use Illuminate\Http\Request;

class CodeController extends Controller
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
        $request->validate([
            'uuid' => 'required|unique:codes|max:37|min:17',
            'content' => 'required',
            'valid_until' => 'nullable|date'
        ],[
            'uuid.required' => "Je moet een code opgeven.",
            'uuid.unique' => "Deze code is al gebruikt.",
            'uuid.max' => "Je code is te lang, je code moet 37 tekens of 17 tekens lang zijn.",
            'uuid.min' => "Je code is te kort, je code moet 37 tekens of 17 tekens lang zijn.",
            'content.required' => "Je moet opgeven wat de gebruiker zal winnen.",
            'valid_until.date' => "De datum tot wanneer de code geldig is moet een datum zijn."
        ]);

        $code = new Code;
        $code->uuid = $request['content'];
        $code->content = $request['content'];
        $code->valid_until = $request['content'];

        if($code->isValid()){
            $code->save();
            //TODO: Flash Request
            return back();
        }
        //TODO: Flash Request
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function show(Code $code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Code $code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Code $code)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Code $code)
    {
        //
    }
}
