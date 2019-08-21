<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Repositories\QuizRepository;
use App\Repositories\QuizRepositoryInterface;
use App\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class ViewController extends Controller
{

    protected $quizRepository;

    public function __construct(QuizRepository $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    /**
     * View start page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function start()
    {
        $results = Result::with('user')->paginate(10);
        return view('start', compact('results'));
    }

    public function logicStart(CreateUserRequest $request)
    {
        $this->quizRepository->storeUser($request);
        $this->quizRepository->storeDataSession($request);
        return redirect()->action('ViewController@viewPage2');
    }

    public function viewPage2()
    {
        return view('page2');
    }

    public function logicPage2(CreateUserRequest $request)
    {
        $this->quizRepository->logicPage2($request);
        $this->quizRepository->addRating();
        return redirect()->action('ViewController@viewPage3');
    }

    public function viewPage3()
    {
        $number1 = rand(10, 99);
        $number2 = rand(10, 99);
        return view('page3', compact('number1', 'number2'));
    }

    public function logicPage3(Request $request)
    {
        $this->quizRepository->checkSum( $request);
        $this->quizRepository->addRating();

        return redirect()->action('ViewController@viewPage4');
    }

    public function viewPage4()
    {
        return view('page4');
    }

    public function logicPage4(Request $request)
    {
        $this->quizRepository->checkLanguage($request);
        $this->quizRepository->addRating();

        return redirect()->action('ViewController@viewPage5');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewPage5()
    {
        $data = $this->quizRepository->getDays();
        return view('page5', compact('data'));
    }

    public function logicPage5(Request $request)
    {
        $this->quizRepository->addRating();

        $date = Carbon::now()->isoFormat('dddd');
        if ($request->day == $date)
            echo 'Ok';
        return redirect()->action('ViewController@finish');
    }

    public function finish()
    {
        $duration = $this->quizRepository->getQuizTime();
        return view('finish', compact('duration'));
    }

    public function rating()
    {

        return $this->quizRepository->addRating();
    }

    public function test()
    {
        return $this->quizRepository->addRating();
//        $session = session()->push('user.email', 'yura@admin');
//        $today=today()->isoFormat('dddd');
////        session()->flash('user');
//        return dump($today);
    }
}
