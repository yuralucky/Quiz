<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 13.08.19
 * Time: 15:24
 */

namespace App\Repositories;


use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;

interface QuizRepositoryInterface
{
    public function storeUser(CreateUserRequest $request);

    public function findUser($id);

    public function storeResult(Request $request);


}