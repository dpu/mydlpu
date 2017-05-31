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

            //TODO mock测试账号和数据
            if ($username == '1305040000') return '{"0":{"0":{"0":{"name":"\u6570\u636e\u5e93\u539f\u7406","week":"1-5,7-9,11-13","room":"\u7efcB331","teacher":"\u6c88\u5c9a"}},"2":{"0":{"name":"\u7f51\u7edc\u7a0b\u5e8f\u8bbe\u8ba1","week":"1-5,7-9,11-14,16","room":"\u7efcA423","teacher":"\u8096\u9e4f"}},"3":{"0":{"name":"\u7f51\u7ad9\u8bbe\u8ba1\u4e0e\u7ba1\u7406","week":"1-5,7-9,11-14","room":"\u7efcB331","teacher":"\u8096\u9e4f"}}},"1":{"0":{"0":{"name":"\u8ba1\u7b97\u673a\u7ec4\u6210\u539f\u7406","week":"1-5,7-9,11-16","room":"\u7efcA414","teacher":"\u5c39\u8273\u8f89"}},"1":{"0":{"name":"\u7f51\u7edc\u534f\u8bae\u539f\u7406","week":"1-5,7-9,11-14","room":"\u7efcA423","teacher":"\u960e\u4e15\u6d9b"}}},"2":{"0":{"0":{"name":"\u5927\u5b66\u82f1\u8bed1","week":"4-5,7-16","room":"\u7efcC209","teacher":"\u5f20\u96ea"}},"1":{"0":{"name":"LINUX\u7cfb\u7edf\u4e0e\u7f16\u7a0b","week":"1-5,7-9,11-12","room":"\u7efcB331","teacher":"\u674e\u660e\u971e"}}},"3":{"1":{"0":{"name":"\u6570\u636e\u5e93\u539f\u7406","week":"1-5,7-9,11-13","room":"\u7efcB331","teacher":"\u6c88\u5c9a"}},"2":{"0":{"name":"\u7f51\u7edc\u534f\u8bae\u539f\u7406","week":"1-5,7-9,11-14","room":"\u7efcA423","teacher":"\u960e\u4e15\u6d9b"}},"3":{"0":{"name":"\u7f51\u7edc\u7a0b\u5e8f\u8bbe\u8ba1","week":"1-5,7-9,11-14,16","room":"\u7efcA423","teacher":"\u8096\u9e4f"}}},"4":{"1":{"0":{"name":"\u8ba1\u7b97\u673a\u7ec4\u6210\u539f\u7406","week":"1-5,7-9,11-16","room":"\u7efcA414","teacher":"\u5c39\u8273\u8f89"}},"2":{"0":{"name":"LINUX\u7cfb\u7edf\u4e0e\u7f16\u7a0b","week":"1-5,7-9,11-12","room":"\u7efcB331","teacher":"\u674e\u660e\u971e"},"1":{"name":"\u5927\u5b66\u82f1\u8bed1","week":"4-5,7-14,16-17","room":"\u7efcA634","teacher":"\u5f20\u96ea"}}}}';
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