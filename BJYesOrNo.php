<?php

require_once('BJDeck.php');
require_once('BJDrawOneCard.php');
require_once('BJCalScore.php');

class BJYesOrNo
{
    function yesOrNo($playerDeck, $resultPlayerScores): array
    {
        $BJdeck = new BJDeck();
        $deck = $BJdeck->makeDeck();

        // カードを1枚 引く
        $randomKeys = array_rand($deck);
        $playerDrawOneCard = $deck[$randomKeys];

        // $playerDeck に カードの数値を格納
        $playerDeck[] = $playerDrawOneCard[1];

        $calScore = new BJCalScore();
        $resultPlayerScores = $calScore->calculateScore($playerDeck);

        return [$resultPlayerScores, $playerDrawOneCard];
    }
}
