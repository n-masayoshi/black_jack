<?php

class BJCalFirstTurnScore
{
    public function calFirstTurnScore(array $eachDeck): int
    {
        // 手札に、1 があった場合、その合計値に、-1 して +11 する
        // これは、1 を 11　に入れ替えて 計算するのと同じことを意味する
        $ace = 1;
        $aceTurnedToBeEleven = 11;
        if (in_array($ace, $eachDeck)) {
            $firstTurnScore = array_sum($eachDeck) - $ace + $aceTurnedToBeEleven;
        } else {
            $firstTurnScore = array_sum($eachDeck);
        }
        return $firstTurnScore;
    }
}
