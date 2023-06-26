<?php

require_once('BJCalScore.php');

class BJDealer
{
    public function dealerTurn(int $dealerScore, int $playerScore, array $dealerDeck)
    {
        $BJdeck = new BJDeck();
        $deck = $BJdeck->makeDeck();
        $calScore = new BJCalScore();

        // 合計値 < 17 の間は、ディーラーは カードを1枚引き続ける
        while($dealerScore < 17) {
            $randomKeys = array_rand($deck);
            $dealerDrawOneCard = $deck[$randomKeys];

            echo 'ディーラーが引いた1枚のカードは、' . $dealerDrawOneCard[0] . 'の' . $dealerDrawOneCard[1] . 'です。' . PHP_EOL;

            $dealerDeck[] = $dealerDrawOneCard[1];

            $dealerScore = $calScore->calculateScore($dealerDeck);
        }

        $blackJackNumber = 21;
        if ($dealerScore > $blackJackNumber) {
            echo 'ディーラーの得点は' . $dealerScore . 'です。' . PHP_EOL;
            echo 'プレイヤーの勝ち！';
        } else {
            if ($dealerScore > $playerScore) {
                echo 'ディーラーの得点は' . $dealerScore . 'です。' . PHP_EOL;
                echo 'ディーラーの勝ち！';
            } elseif ($dealerScore < $playerScore) {
                echo 'ディーラーの得点は' . $dealerScore . 'です。' . PHP_EOL;
                echo 'プレイヤーの勝ち！';
            } elseif ($dealerScore === $playerScore) {
                echo 'ディーラーの得点は' . $dealerScore . 'です。' . PHP_EOL;
                echo '引き分け';
            }
        }
    }
}
