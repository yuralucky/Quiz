<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 03.09.19
 * Time: 9:47
 */

namespace App\Services;


use Illuminate\Http\Request;

class LanguageLogic
{
    /**
     * Return shuffle collection
     *
     * @return \Illuminate\Support\Collection
     */
    public function getLanguage()
    {
        $language = collect(['PHP', 'Python', 'JS', '.net', 'Visual Basic'])->shuffle();
        return $language;
    }

    /**
     * Check if isset language and not eq Visual Basic
     *
     * @param Request $request
     * @return string
     */
    public function checkLanguage(Request $request)
    {
        $language = $request->language;
        $answer = (is_null($language) or in_array('Visual Basic', $language)) ? 'error' : 'rightLanguage';
        return $answer;
    }
}