<?php

namespace App\Http\Controllers\Edu;

use App\Http\Controllers\Controller;
use App\Services\Edu\EduService;
use Illuminate\Http\Request;

class EduController extends Controller
{
    public function binding(Request $request)
    {
        $openid = $request->input('openid');
        $username = $request->input('username');
        $password = $request->input('password');
        $mobile = $request->input('mobile');

        $data = (new EduService)->binding($openid, $username, $password, $mobile);

        return view('edu.binding.result')->with('data', $data);
    }

}