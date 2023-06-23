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

        $drawOneCard = new BJDrawOneCard();
        $calScore = new BJCalScore();

        // カードを1枚 引く
        $playerDrawOneCard = $drawOneCard->drawOneCard($deck);

        // $playerDeck に カードの数値を格納
        $playerDeck[] = $playerDrawOneCard[1];

        $resultPlayerScores = $calScore->calculateScore($playerDeck);

        return [$resultPlayerScores, $playerDrawOneCard];
    }
}
