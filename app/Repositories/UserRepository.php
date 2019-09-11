<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 02.09.19
 * Time: 11:13
 */

namespace App\Repositories;


use App\Http\Requests\CreateUserRequest;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Find user use email
     *
     * @param $email
     * @return mixed
     */
    public function show($email)
    {
        $user = User::where('email', $email)->first();

        return $user;
    }

    /**
     * Store user
     *
     * @param CreateUserRequest $request
     * @return bool
     */
    public function store(CreateUserRequest $request)
    {
        $image = $request->file('avatar')->getClientOriginalName();
        $request->file('avatar')->move(public_path('images'), $image);
        User::create([
            'email' => $request->email,
            'avatar' => 'images/' . $image
        ]);
        return false;
    }
}