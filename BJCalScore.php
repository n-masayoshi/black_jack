<?php

class CalScore
{
    function calScore($drawOneCard, $resultScores): int
    {
        return $resultScores + $drawOneCard;
    }
}
