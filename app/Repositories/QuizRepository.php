<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 13.08.19
 * Time: 15:38
 */

namespace App\Repositories;

use App\Http\Requests\CreateUserRequest;
use App\Result;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class QuizRepository implements QuizRepositoryInterface
{
    public function storeUser(CreateUserRequest $request)
    {
        $image = $request->file('avatar')->getClientOriginalName();
        $request->file('avatar')->move(public_path('images'), $image);
        User::create([
            'email' => $request->email,
            'avatar' => 'images/' . $image
        ]);
        return 'Ok';
    }

    public function storeDataSession(CreateUserRequest $request)
    {
        session()->put('start', Carbon::now());
        session()->put('rating', 1);
        session()->put('user', $request->email);
        return response()->json(['session ' => 'saved']);
    }

    public function findUser($id)
    {
        return User::find($id);
    }

    public function logicPage2(CreateUserRequest $request)
    {
        $this->storeUser($request);
        session()->put('start', Carbon::now());
        session()->put('rating', 1);
        session()->put('user_id', $request->id);
        return response();

    }

    public function getDays()
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

    public function getQuizTime()
    {
        $finish = Carbon::now();
        $duration = $finish->diffInSeconds(session()->get('start'));
        return $duration;

    }

    public function checkSum($request)
    {
        $sum = $request->number1 + $request->number2;
        if ($request->summ == $sum) {
            $this->addRating();
        }
        return response();

    }

    public function checkLanguage($request)
    {
        $language = $request->language;
        if (is_null($language) or in_array('Visual Basic', $language)) {
        } else {
            $this->addRating();
        }
    }

    public function storeResult(Request $request)
    {
        $result = new Result();
        $result->rating = $request->rating;
        $result->time = $this->getQuizTime();
        $result->user_id = $request->user_id;
        $result->save();

        return response()->json('created', 'ok');
    }

    public function addRating()
    {
        $rating = session()->get('rating');
        $rating++;
        session()->put('rating', $rating);
        return $rating;
    }
}