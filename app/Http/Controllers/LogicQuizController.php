<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Repositories\QuizRepositoryInterface;
use App\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogicQuizController extends Controller
{
    protected $quizRepository;

    public function __construct(QuizRepositoryInterface $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    public function storeDataSession()
    {
        session()->put('start', Carbon::now());
        session()->put('rating', 1);
        session()->put('user_id', 1);
        return response()->json(['session ' => 'saved']);
    }

    public function logicStart(CreateUserRequest $request)
    {
        $this->quizRepository->storeUser($request);

        return redirect()->route('page2');
    }

    public function logicPage2()
    {

        return redirect()->route('page3');
    }

    public function logicPage3(Request $request)
    {
        $summ = $request->number1 + $request->number2;

    }

    public function logicPage4()
    {

    }

    public function logicPage5()
    {

    }

    public function logicFinish($request)
    {
        $this->quizRepository->saveResult($request);
    }

}
