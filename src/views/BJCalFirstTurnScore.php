<?php

class FirstTurnScore
{
    function calFirstTurnScore(array $cards): int
    {
        $ace = 1;
        $aceTurnedToBeEleven = 11;
        // 2枚のカードの内、どちらかが 1　の場合、それを 11 として計算する。
        if ($cards[0][1] === $ace && $cards[1][1] !== $ace) {
            $cards[0][1] = $aceTurnedToBeEleven;
        } elseif ($cards[1][1] === $ace && $cards[0][1] !== $ace) {
            $cards[1][1] = $aceTurnedToBeEleven;
        } elseif ($cards[0][1] === $ace && $cards[1][1] === $ace) {
            $cards[0][1] = $aceTurnedToBeEleven;
        }
        $firstTurnScore = $cards[0][1] + $cards[1][1];
        return $firstTurnScore;
    }
}
