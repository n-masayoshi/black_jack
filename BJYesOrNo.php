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

        $drawOneCard = new DrawOneCard();
        $calScore = new CalScore();

        // カードを1枚 引く
        $playerDrawOneCard = $drawOneCard->drawOneCard($deck);

        // $playerDeck に カードの数値を格納
        $playerDeck[] = $playerDrawOneCard[1];

        $resultPlayerScores = $calScore->calScore($playerDeck);

        return [$resultPlayerScores, $playerDrawOneCard];
    }
}
