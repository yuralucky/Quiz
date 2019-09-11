<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 02.09.19
 * Time: 12:30
 */

namespace App\Services;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TimeLogic
{

    /**
     * Get duration quiz
     *
     * @return int
     */
    public function getQuizTime()
    {
        $duration = now()->diffInSeconds(session('user.start'));
        return $duration;
    }

    /**
     * Get random days
     *
     * @return array|\Illuminate\Support\Collection
     */
    public function getRandomDays()
    {
        $key = array(1, 2, 3, 4, 5, 6);
        $data = Arr::random($key, 3);
        $days[] = now()->isoFormat('dddd');
        $days[] = now()->addDay($data[0])->isoFormat('dddd');
        $days[] = now()->addDay($data[1])->isoFormat('dddd');
        $days[] = now()->addDay($data[2])->isoFormat('dddd');
        $days = collect($days)->shuffle();

        return $days;
    }


    /**
     * Check day
     *
     * @param Request $request
     * @return string
     */
    public function checkDate(Request $request)
    {
        $date = now()->isoFormat('dddd');
        $answer = ($date == $request->day) ? 'rightDay' : 'error';
        return $answer;
    }




}