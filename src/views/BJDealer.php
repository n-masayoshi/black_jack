<?php

require_once('BJDrawOneCard.php');
require_once('BJDeck.php');

class BJDealer
{
    function dealerTurn
    (
        int $resultDealerScores, array $dealerDeck, int $resultPlayerScores
    ): void
    {
        $drawOneCard = new BJDrawOneCard();
        $calScore = new BJCalScore();
        $BJdeck = new BJDeck();
        $deck = $BJdeck->makeDeck();

        // 合計値 < 17 の間は、ディーラーは カードを1枚引き続ける
        while($resultDealerScores < 17) {
            $dealerDrawOneCard = $drawOneCard->drawOneCard($deck);

            echo 'ディーラーが引いた1枚のカードは、' . $dealerDrawOneCard[0] . 'の' . $dealerDrawOneCard[1] . 'です。<br>';

            $dealerDeck = $dealerDrawOneCard[1];

            $resultDealerScores = $calScore->calculateScore($dealerDeck);
        }

        $blackJackNumber = 21;
        if ($resultDealerScores > $blackJackNumber) {
            echo 'ディーラーの得点は' . $resultDealerScores . 'です。<br>';
            echo 'プレイヤーの勝ち！<br>';
        } else {
            if ($resultDealerScores > $resultPlayerScores) {
                echo 'ディーラーの得点は' . $resultDealerScores . 'です。<br>';
                echo 'ディーラーの勝ち！<br>';
            } elseif ($resultDealerScores < $resultPlayerScores) {
                echo 'ディーラーの得点は' . $resultDealerScores . 'です。<br>';
                echo 'プレイヤーの勝ち！<br>';
            } elseif ($resultDealerScores === $resultPlayerScores) {
                echo 'ディーラーの得点は' . $resultDealerScores . 'です。<br>';
                echo '引き分け<br>';
            }
        }
    }
}
