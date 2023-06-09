<?php

class CalFirstTurnScore
{
    function calFirstTurnScore(array $cards): int
    {
        $aceNumberEleven = 11;
        if ($cards[0][1] === 1 && $cards[1][1] !== 1) {
            $cards[0][1] = $aceNumberEleven;
        } elseif ($cards[1][1] === 1 && $cards[0][1] !== 1) {
            $cards[1][1] = $aceNumberEleven;
        } elseif ($cards[0][1] === 1 && $cards[1][1] === 1) {
            $cards[0][1] = $aceNumberEleven;
        }
        $firstTurnScore = (int) $cards[0][1] + $cards[1][1];
        return $firstTurnScore;
    }
}
