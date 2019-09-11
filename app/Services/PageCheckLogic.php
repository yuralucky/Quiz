<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 02.09.19
 * Time: 13:50
 */

namespace App\Services;


use App\Http\Requests\CreateUserRequest;
use App\Repositories\ResultRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class PageCheckLogic
{

    protected $userRepository;
    protected $resultRepository;
    protected $timeLogic;
    protected $mathLogic;
    protected $languageLogic;
    protected $sessionLogic;

    /**
     * PageCheckLogic constructor.
     * @param UserRepositoryInterface $userRepository
     * @param ResultRepositoryInterface $resultRepository
     * @param MathLogic $mathLogic
     * @param TimeLogic $timeLogic
     * @param SessionLogic $sessionLogic
     * @param LanguageLogic $languageLogic
     */
    public function __construct(UserRepositoryInterface $userRepository,
                                ResultRepositoryInterface $resultRepository,
                                MathLogic $mathLogic,
                                TimeLogic $timeLogic,
                                SessionLogic $sessionLogic,
                                LanguageLogic $languageLogic)
    {
        $this->resultRepository = $resultRepository;
        $this->userRepository = $userRepository;
        $this->timeLogic = $timeLogic;
        $this->mathLogic = $mathLogic;
        $this->sessionLogic = $sessionLogic;
        $this->languageLogic = $languageLogic;
    }

    /**
     * Get last 10 results
     *
     * @return mixed
     */
    public function getDataPageStart()
    {
        return $this->resultRepository->lastResult();
    }

    /**
     * Save new user and create new session
     *
     * @param CreateUserRequest $request
     * @return bool
     */
    public function logicStartPage(CreateUserRequest $request)
    {
        $this->userRepository->store($request);
        $this->sessionLogic->storeUserSession($request);
        return true;
    }

    /**
     * Check page2
     *
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function logicPage2()
    {
        return $this->sessionLogic->addRating('firstBall');
    }

    /**
     * Get 2 random number
     *
     * @return array
     */
    public function getDataPage3()
    {
        return $this->mathLogic->randNumber();
    }

    /**
     * Check sum and add rating
     *
     * @param $request
     * @return string
     */
    public function logicPage3($request)
    {
        $result = $this->mathLogic->checkSum($request);
        $result = ($result == 'rightSum') ? $this->sessionLogic->addRating($result) : 0;
        return $result;
    }

    /**
     * Show random language
     *
     * @return \Illuminate\Support\Collection
     */
    public function getDataPage4()
    {
        return $this->languageLogic->getLanguage();
    }

    /**
     * Check logic page4
     *
     * @param Request $request
     * @return string
     */
    public function logicPage4(Request $request)
    {
        $result = $this->languageLogic->checkLanguage($request);
        $result = ($result == 'rightLanguage') ? $this->sessionLogic->addRating($result) : 0;
        return $result;
    }

    /**
     * Show random 4 days include today
     *
     * @return TimeLogic|array
     */
    public function getDataPage5()
    {
        return $this->timeLogic->getRandomDays();
    }


    /**
     * Check logic page5
     *
     * @param Request $request
     * @return bool|int|string
     */
    public function logicPage5(Request $request)
    {
        $result = $this->timeLogic->checkDate($request);
        $result = ($result == 'rightDay') ? $this->sessionLogic->addRating($result) : 0;
        return $result;
    }

    /**
     * Show finish page
     *
     * @return array
     */
    public function getDataPageFinish()
    {
        $user['duration'] = $this->timeLogic->getQuizTime();
        $user['rating'] = $this->sessionLogic->showRating();
        $user['email'] = $this->sessionLogic->showEmail();
        $user['id'] = $this->userRepository->show($user['email']);
        return $user;
    }

    /**
     * Store result
     *
     * @param Request $request
     * @return mixed
     */
    public function logicFinish(Request $request)
    {
        return $this->resultRepository->store($request);

    }


}