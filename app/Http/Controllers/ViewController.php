<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Services\PageCheckLogic;
use Illuminate\Http\Request;


class ViewController extends Controller
{

    protected $pageCheckLogic;

    public function __construct(PageCheckLogic $pageCheckLogic)
    {
        $this->pageCheckLogic = $pageCheckLogic;
    }

    /**
     * View start page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function start()
    {
        $results = $this->pageCheckLogic->getDataPageStart();
        return view('start', compact('results'));
    }

    /**
     * Make all logic from start page
     *
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logicPageStart(CreateUserRequest $request)
    {
        $this->pageCheckLogic->logicStartPage($request);
        return redirect()->action('ViewController@viewPage2');
    }

    /**
     * Show page 2
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewPage2()
    {
        return view('page2');
    }

    /**
     * Make all logic from  page2
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logicPage2()
    {
        $this->pageCheckLogic->logicPage2();
        return redirect()->action('ViewController@viewPage3');
    }


    /**
     * Show page 3
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewPage3()
    {
        $randNumber = $this->pageCheckLogic->getDataPage3();
        return view('page3', compact('randNumber'));
    }

    /**
     * Make all logic from  page3
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logicPage3(Request $request)
    {
        $this->pageCheckLogic->logicPage3($request);
        return redirect()->action('ViewController@viewPage4');
    }


    /**
     * Show page4
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewPage4()
    {
        $languages = $this->pageCheckLogic->getDataPage4();
        return view('page4', compact('languages'));
    }

    /**
     *  Make all logic from  page4
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logicPage4(Request $request)
    {
        $this->pageCheckLogic->logicPage4($request);
        return redirect()->action('ViewController@viewPage5');
    }

    /**
     * Show page5
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewPage5()
    {
        $data = $this->pageCheckLogic->getDataPage5();
        return view('page5', compact('data'));
    }

    /**
     *  Make all logic from  page5
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logicPage5(Request $request)
    {
        $this->pageCheckLogic->logicPage5($request);
        return redirect()->action('ViewController@finish');
    }

    /**
     *  Collect and show all result
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish()
    {
        $user = $this->pageCheckLogic->getDataPageFinish();
        return view('finish', compact('user'));
    }


    /**
     * Save quiz result
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logicFinish(Request $request)
    {
        $this->pageCheckLogic->logicFinish($request);
        return redirect()->action('ViewController@start');
    }


}
