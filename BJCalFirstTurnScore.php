<?php

class CalFirstTurnScore
{
    function calFirstTurnScore(array $cards): int
    {
        $firstTurnScore = (int) $cards[0][1] + $cards[1][1];
        return $firstTurnScore;
    }
}
