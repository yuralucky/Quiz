<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 02.09.19
 * Time: 11:03
 */

namespace App\Repositories;

use Illuminate\Http\Request;

interface ResultRepositoryInterface
{
    public function show($id);

    public function lastResult();

    public function store(Request $request);
}