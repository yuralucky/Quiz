<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Result;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class QuizController extends Controller
{
    /**
     * Show start page and result table
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $results = Result::with('user')->paginate(10);
        return view('start', compact('results'));
    }

    /**
     * Create new user
     *
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        $image = $request->file('avatar')->getClientOriginalName();
        $request->file('avatar')->move(public_path('images'), $image);
        $user = User::create([
            'email' => $request->email,
            'avatar' => 'images/' . $image
        ]);
        $request->session()->put('user_id', $user->id);
        $request->session()->put('email', $user->email);

        return redirect()->route('page2')->with('success', 'Вы успешно зарегистрировались');

    }

    /**
     * Show first question
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page2(Request $request)
    {
        $start = Carbon::now();
        $request->session()->put('rating', 1);
        $request->session()->put('start', $start);
        $user_id = $request->session()->get('user_id');
        return view('page2', compact('user_id'));

    }

    /**
     * Save result
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page31(Request $request)
    {
        $rating = $request->session()->get('rating');
        return view('page3', compact('rating'));
    }

    /**
     * Show second question
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page3(Request $request)
    {
        $number1 = rand(10, 99);
        $number2 = rand(10, 99);
        $rating = $request->session()->get('rating');
        $user_id = $request->session()->get('user_id');
        return view('page3', compact('rating', 'number1', 'number2', 'user_id'))->with('success', 'Вы заработали свой первый бал!');
    }


    /**
     * Save result
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page4(Request $request)
    {
        $rating = $request->session()->get('rating');
        $summ = $request->number1 + $request->number2;
        if ($request->summ == $summ) {
            $rating++;
        }
        $request->session()->put('rating', $rating);

        return view('page4', compact('rating'));

    }


    /**
     * Show last question
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page5(Request $request)
    {
        $rating = $request->session()->get('rating');
        $language = $request->language;
        if (is_null($language) or in_array('Visual Basic', $language)) {
        } else {
            $rating++;
        }
        $request->session()->put('rating', $rating);

        $currentDay[0] = Carbon::now()->isoFormat('dddd');
        $currentDay[1] = Carbon::now()->addDay(1)->isoFormat('dddd');
        $currentDay[2] = Carbon::now()->addDay(3)->isoFormat('dddd');
        $currentDay[3] = Carbon::now()->addDay(5)->isoFormat('dddd');

        return view('page5', compact('rating', 'currentDay'));

    }

    /**
     * Checked date question
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function actionPage5(Request $request)
    {
        $rating = $request->session()->get('rating');
        $date = Carbon::now()->isoFormat('dddd');
        if ($request->day == $date)
            $rating++;
        $request->session()->put('rating', $rating);

        return redirect()->route('end');
    }

    /**
     * Show and save result
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(Request $request)
    {
        $finish = Carbon::now();
        $rating = $request->session()->get('rating');
        $user_id = $request->session()->get('user_id');
        $user = User::find($user_id);

        $duration = $finish->diffInSeconds($request->session()->get('start'));

        $result = new Result();
        $result->rating = $rating;
        $result->time = $duration;
        $result->user_id = $user_id;
        $result->save();

        return view('finish', compact('duration', 'rating', 'user_id', 'user'));
    }
}
