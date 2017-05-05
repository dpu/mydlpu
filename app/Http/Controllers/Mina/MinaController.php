<?php

namespace App\Http\Controllers\Mina;

use App\Http\Controllers\Controller;
use App\Services\Mina\MinaService;
use Illuminate\Http\Request;

class MinaController extends Controller
{
    public function timetable(Request $request)
    {
        try {
            $username = $request->input('stuid');
            $password = $request->input('stupwd');
            $semester = $request->input('semester', config('edu.semester'));
            $week = $request->input('week', '');
            $timetable = (new MinaService)->timetable($username, $password, $semester, $week);
            return response()->json($timetable, 200, [], JSON_FORCE_OBJECT)->setCallback($request->input('callback'));
        } catch (\Throwable $t) {
            return response()->json(['errmsg' => $t->getMessage()], 404)->setCallback($request->input('callback'));
        }
    }

    public function currentTime(Request $request)
    {
        try {
            $currentTime = (new MinaService)->currentTime();
            return response()->json(['semester' => $currentTime['semester'], 'week' => $currentTime['week']], 200, [], JSON_FORCE_OBJECT)->setCallback($request->input('callback'));
        } catch (\Throwable $t) {
            return response()->json(['errmsg' => $t->getMessage()], 404)->setCallback($request->input('callback'));
        }
    }

    public function feedback(Request $request)
    {
        try {
            $content = $request->input('content', '');
            (new MinaService)->feedback($content);
            return response()->json([], 200);
        } catch (\Throwable $t) {
            return response()->json(['errmsg' => $t->getMessage()], 500);
        }
    }

}