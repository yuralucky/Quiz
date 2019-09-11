<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 30.08.19
 * Time: 10:41
 */

namespace App\Services;

use Illuminate\Http\Request;

class MathLogic
{


    /**
     * Get 2 rundom numbers
     *
     * @return array
     */
    public function randNumber()
    {
        $arr[] = rand(10, 99);
        $arr[] = rand(10, 99);
        return $arr;
    }

    /**
     * Check sum
     *
     * @param Request $request
     * @return string
     */
    public function checkSum(Request $request)
    {
        $sum = $request->number1 + $request->number2;
        $rating = ($request->sum == $sum) ? 'rightSum' : 'error';

        return $rating;
    }


}