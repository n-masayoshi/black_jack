<?php

class BJCalScore
{
    function calculateScore(array $eachDeck): int
    {
        // 手札に、1 があった場合、その合計値に、-1 して +11 する
        // これは、1 を 11　に入れ替えて 計算するのと同じことを意味する
        $ace = 1;
        $aceTurnedToBeEleven = 11;
        if (in_array($ace, $eachDeck)) {
            $totalScore = array_sum($eachDeck) - $ace + $aceTurnedToBeEleven;
            if ($totalScore > 21) {
                $totalScore = array_sum($eachDeck);
            }
        } else {
            $totalScore = array_sum($eachDeck);
        }
        return $totalScore;
    }
}
