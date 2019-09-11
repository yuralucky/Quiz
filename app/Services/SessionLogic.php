<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 09.09.19
 * Time: 10:16
 */

namespace App\Services;


use App\Http\Requests\CreateUserRequest;

class SessionLogic
{

    /**
     * Save into session users info
     *
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeUserSession(CreateUserRequest $request)
    {
        session()->flush();
        session()->put('user.start', now());
        session()->put('user.rating', []);
        session()->put('user.email', $request->email);
        return response()->json(['session ' => 'saved']);
    }

    /**
     * Add rating and put into session
     *
     * @param $data
     * @return bool
     */
    public function addRating($data)
    {
        if (!in_array($data, session('user.rating'))) session()->push('user.rating', $data);
        return true;
    }

    /**
     * Show user email
     *
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function showEmail()
    {
        return session('user.email');
    }

    /**
     * Return finish rating
     *
     * @return int
     */
    public function showRating(): int
    {
        $ses = count(session('user.rating')) ?? 0;
        return $ses;
    }

}