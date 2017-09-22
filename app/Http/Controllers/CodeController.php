<?php

namespace App\Http\Controllers;

use App\Code;
use App\JWT\JWTWrapper;
use Illuminate\Http\Request;

class CodeController extends Controller
{

    protected $wrapper;

    public function __construct(JWTWrapper $wrapper)
    {
        $this->wrapper = $wrapper;
    }

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO: To Request Handler
        $request->validate([
            'uuid' => 'required|unique:codes|max:37|min:16',
            'content' => 'required',
            'valid_until' => 'nullable|date'
        ], [
            'uuid.required' => "Je moet een code opgeven.",
            'uuid.unique' => "Deze code is al gebruikt.",
            'uuid.max' => "Je code is te lang, je code moet 37 tekens of 17 tekens lang zijn.",
            'uuid.min' => "Je code is te kort, je code moet 37 tekens of 17 tekens lang zijn.",
            'content.required' => "Je moet opgeven wat de gebruiker zal winnen.",
            'valid_until.date' => "De datum tot wanneer de code geldig is moet een datum zijn."
        ]);

        $code = Code::create([
            'uuid' => $request['content'],
            'content' => $request['content'],
            'valid_until' => $request['valid_until'],
        ]);

        if($code->can_use){
            //TODO: Flash Request
        }else {
            flash('Deze code is niet te gebruiken.')->error();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Code $code
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //TODO: To Request Handler
        $request->validate([
            'uuid' => 'required|max:37|min:16'
        ], [
            'uuid.required' => "Je moet een code opgeven.",
            'uuid.max' => "Je code is te lang, je code moet 37 tekens of 17 tekens lang zijn.",
            'uuid.min' => "Je code is te kort, je code moet 37 tekens of 17 tekens lang zijn."
        ]);

        $code = Code::where('uuid', $request['uuid'])->first();
        if (!is_null($code)) {
            if ($code->can_use) {
                $this->wrapper->addData("code", $code->uuid);
                $this->wrapper->addData("form", true);
                session(['code' => $this->wrapper->sign()]);
                flash('Je hebt een juiste code ingevoerd!')->success();
            } else {
                flash('Je code is niet meer geldig, probeer een andere code!')->error();
            }
            $code->delete();
            return back();
        }
        flash('Deze code is niet bekend bij ons.')->error();
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Code $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Code $code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Code $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Code $code)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Code $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Code $code)
    {
        //
    }
}
