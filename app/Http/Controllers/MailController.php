<?php

namespace App\Http\Controllers;

use App\Code;
use App\JWT\JWTWrapper;
use App\Mail\CodeResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

class MailController extends Controller
{

    public function send(Request $request)
    {
        $this->validate($request, [
            //TODO: Validation rule
            'code' => 'required',
            'token' => 'required',
            'email' => 'email|required',
            'firstname' => 'required',
            'lastname' => 'required',
            'adres' => 'required',
            'age' => 'required|min:0|max:100',
        ]);
        $code = Code::where('uuid', Input::get('code'))->withTrashed()->first();
        $data = [
            'uuid' => $code->uuid,
            'content' => $code->content
        ];
        //TODO: Verify here
        return response($data, 200);
   /*     Mail::to(Input::get('email'))
            ->queue(new CodeResult([
                'content' => $content
            ]));*/
        flash("Je hebt een mail gekregen met daarin jouw prijs!")->success();
        return Input::all();
    }

}
