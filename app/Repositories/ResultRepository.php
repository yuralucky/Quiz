<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 02.09.19
 * Time: 11:19
 */

namespace App\Repositories;


use App\Result;
use App\User;
use Illuminate\Http\Request;


class ResultRepository implements ResultRepositoryInterface
{
    /**
     * Find  result
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $result = Result::find($id);
        return $result;
    }

    /**
     * Show last 10 results with relations
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function lastResult()
    {
        $results = Result::with('user')->paginate(10);
        return $results;

    }

    /**
     * Store result
     *
     * @param Request $request
     * @return Result
     */
    public function store(Request $request)
    {
        $result = new Result();
        $result->rating = $request->rating;
        $result->time = $request->duration;
        $result->user_id = $request->user_id;
        $result->save();

        return $result;
    }
}