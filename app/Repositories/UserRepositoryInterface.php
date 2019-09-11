<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 02.09.19
 * Time: 11:01
 */

namespace App\Repositories;


use App\Http\Requests\CreateUserRequest;

interface UserRepositoryInterface
{
    public function show($id);

    public function store(CreateUserRequest $request);
}