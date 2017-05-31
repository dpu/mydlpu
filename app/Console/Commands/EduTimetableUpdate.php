<?php

namespace App\Console\Commands;

use App\Services\Edu\EduService;
use App\Services\LogService;
use Illuminate\Console\Command;


class EduTimetableUpdate extends Command
{
    protected $signature = 'edu:timetable';

    protected $description = 'Edu timetable auto update...';

    public function handle()
    {
        $eduService = new EduService();

        try {
            $week = $eduService->getCurrentWeek();
        } catch (\Throwable $t) {
            $week = '';
            LogService::edu('EduTimetableUpdate handle getCurrentWeek error...', [$t->getMessage(), $t->getTrace()]);
        }

        $users = $this->getUsernamePassword();
        foreach ($users as $username => $password) {
            $semester = config('edu.semester');
            //TODO 13级学生走2015-2016-1
            if (substr($username, 0, 2) == '13') $semester = '2015-2016-1';
            try {
                $this->saveTimetable($eduService, $username, $password, $semester, $week);
                sleep(random_int(1, 3));
            } catch (\Throwable $t) {
                LogService::edu('EduNewsListUpdate handle error...', [$username, $password, $t->getMessage(), $t->getTrace()]);
            }
        }
    }

    private function saveTimetable(EduService $eduService, $username, $password, $semester, $week)
    {
        $token = $eduService->getToken($username, $password);
        sleep(1);
        $timetable = @$eduService->getTimetable($token, $semester, $week);
        if (is_null($timetable)) $timetable = @$eduService->getTimetable($token, $semester, $week);
        $this->save($username, $semester, $week, json_encode($timetable));
    }

    private function save($username, $semester, $week, $content)
    {
        $this->delete($username, $semester, $week);
        $modeEduTimetable = new \App\Models\EduTimetable;
        $modeEduTimetable->username = $username;
        $modeEduTimetable->semester = $semester;
        $modeEduTimetable->week = $week;
        $modeEduTimetable->content = $content;
        $modeEduTimetable->save();
        return true;
    }

    private function delete($username, $semester, $week)
    {
        return \App\Models\EduTimetable::where('username', $username)->where('semester', $semester)->where('week', $week)->delete();
    }

    private function getUsernamePassword()
    {
        $modelEduUsers = \App\Models\EduUsers::select(['username', 'password'])->get()->toArray();
        $modelMinaUsers = \App\Models\MinaUsers::select(['username', 'password'])->get()->toArray();
        $modelUsers = array_merge($modelEduUsers, $modelMinaUsers);

        $users = [];
        foreach ($modelUsers as $modelUser) {
            $users[$modelUser['username']] = $modelUser['password'];
        }

        return $users;
    }
}
