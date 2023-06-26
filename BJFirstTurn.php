<?php

require_once('BJDeck.php');
require_once('BJCalFirstTurnScore.php');

class BJFirstTurn
{
    public function firstTurn():array
    {
        $BJdeck = new BJDeck();
        $BJdeck->makeDeck();

        for ($i = 0; $i < 2; $i++) {
            $twoCards = $BJdeck->getTwoCards();
            if ($i === 0) {
                $playerTwoCards = $twoCards;
                $playerFirstCard = $playerTwoCards[0];
                $playerSecondCard = $playerTwoCards[1];

                // $playerDeck に 2枚のカードの数値を格納
                $playerDeck[] = $playerFirstCard[1];
                $playerDeck[] = $playerSecondCard[1];

                echo 'あなたの1枚目のカードは、' . $playerFirstCard[0] . 'の' . $playerFirstCard[1] . 'です。' . PHP_EOL;

                echo 'あなたの2枚目のカードは、' . $playerSecondCard[0] . 'の' .$playerSecondCard[1] . 'です。' . PHP_EOL;
            } else {
                $dealerTwoCards =$twoCards;
                $dealerFirstCard = $dealerTwoCards[0];
                $dealerSecondCard = $dealerTwoCards[1];

                // $dealerDeck に それぞれのカードの数値を格納
                $dealerDeck[] = $dealerFirstCard[1];
                $dealerDeck[] = $dealerSecondCard[1];

                echo 'ディーラーの1枚目のカードは、' . $dealerFirstCard[0] . 'の' . $dealerFirstCard[1] . 'です。' . PHP_EOL;
                echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;
            }
        }

        // 最初のターン：$player, $dealer 各々の最初の2枚の合計値
        $calFirstTurnScore = new BJCalFirstTurnScore();

        // プレイヤーの１回目のターンの合計値
        $resultPlayerScores = $calFirstTurnScore->calFirstTurnScore($playerDeck);

        // ディーラーの１回目のターンの合計値
        $resultDealerScores = $calFirstTurnScore->calFirstTurnScore($dealerDeck);

        // 最初に合計値が、決まるのは プレイヤー
        echo 'あなたの現在の得点は' . $resultPlayerScores . 'です。カードを引きますか？（Y/N）';
        return [$playerDeck, $dealerDeck, $resultPlayerScores, $resultDealerScores];
    }
}
