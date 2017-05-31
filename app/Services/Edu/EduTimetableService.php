<?php

namespace App\Services\Edu;

class EduTimetableService
{

    public static function get($username, $semester, $week)
    {
        $model = \App\Models\EduTimetable::where('username', $username)->where('semester', $semester)->where('week', $week)->first();
        if($model) return json_decode($model->content, true);
    }

}