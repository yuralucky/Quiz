<?php

class Rating
{
    private static $rating;

    private function __construct()
    {
    }

    private function __clone()
    {
        throw new Exception('Rating is existing');

    }

    public static function getRating()
    {
        if (is_null(static::$rating)) {
            static::$rating = new Rating();
        }
        return static::$rating;
    }


}

$rating=Rating::getRating();
$rating1=Rating::getRating();
if($rating===$rating)
{
    print 'ok';
}