<?php

require_once('BJDeck.php');
require_once('BJCalFirstTurnScore.php');
require_once('BJDrawOneCard.php');
require_once('BJCalScore.php');

class BJGame
{
    private array $playerTwoCards;
    private array $dealerTwoCards;
    private int $resultPlayerScores;
    private int $resultDealerScores;
    private string $yesOrNo;
    public function __construct
    (
    )
    {
    }

    public function start()
    {
        echo 'ブラックジャックを開始します。' . PHP_EOL;
        $BJdeck = new BJDeck();
        $deck = $BJdeck->makeDeck();

        for ($i = 0; $i < 2; $i++) {
            $twoCards = $BJdeck->getTwoCards();
            if ($i === 0) {
                $this->playerTwoCards = $twoCards;
                $playerFirstCard = $this->playerTwoCards[0];
                $playerSecondCard = $this->playerTwoCards[1];
                echo 'あなたの1枚目のカードは、' . $playerFirstCard[0] . 'の' . $playerFirstCard[1] . 'です。' . PHP_EOL;
                echo 'あなたの2枚目のカードは、' . $playerSecondCard[0] . 'の' .$playerSecondCard[1] . 'です。' . PHP_EOL;
            } else {
                $this->dealerTwoCards =$twoCards;
                $dealerFirstCard = $this->dealerTwoCards[0];
                echo 'ディーラーの1枚目のカードは、' . $dealerFirstCard[0] . 'の' . $dealerFirstCard[1] . 'です。' . PHP_EOL;
                echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;
            }
        }

        // 最初の回：$player, $dealer 各々の最初の2枚の合計値
        $calFirstTurnScore = new CalFirstTurnScore();

        // プレイヤーの １回目のターンの合計値
        $this->resultPlayerScores = $calFirstTurnScore->calFirstTurnScore($this->playerTwoCards);

        // TODO:あとで、消す
        echo 'あなたの現在の得点は' . $this->resultPlayerScores . 'です。' . PHP_EOL;

        // ディーラーの １回目のターンの合計値
        $this->resultDealerScores = $calFirstTurnScore->calFirstTurnScore($this->dealerTwoCards);

        // TODO:あとで、消す
        echo 'ディーラーの現在の得点は' . $this->resultDealerScores . 'です。' . PHP_EOL;


        // 合計値 < 18 の間は、プレイヤーは カードを1枚引き続ける
        $drawOneCard = new DrawOneCard();
        $calScore = new CalScore();
        while ($this->resultPlayerScores < 18) {
            $playerDrawOneCard = $drawOneCard->drawOneCard($deck);

            echo 'あなたが引いた1枚のカードは、' . $playerDrawOneCard[0] . 'の' . $playerDrawOneCard[1] . 'です。' . PHP_EOL;

            $this->resultPlayerScores = $calScore->calScore($playerDrawOneCard[1], $this->resultPlayerScores);
        }

        $blackJackNumber = 21;
        // 最初に、合計値が、決まるのは プレイヤー
        // プレイヤーの合計値が、21 を超えたら、自動で、ディーラーの勝ち
        if ($this->resultPlayerScores > $blackJackNumber) {
            // TODO:あとで、消す
            echo 'あなたの現在の得点は' . $this->resultPlayerScores . 'です。' . PHP_EOL;
            echo 'ディーラーの勝ち！' . PHP_EOL;
            die();
        } else {
            echo 'あなたの現在の得点は' . $this->resultPlayerScores . 'です。カードを引きますか？（Y/N）';
            $this->yesOrNo = trim(fgets(STDIN));
            if ($this->yesOrNo === 'y' || $this->yesOrNo === 'Y') {
                // カードを1枚 引く
                $playerDrawOneCard = $drawOneCard->drawOneCard($deck);
                $this->resultPlayerScores = $calScore->calScore($playerDrawOneCard[1], $this->resultPlayerScores);
                if ($this->resultPlayerScores > $blackJackNumber) {
                    echo 'ディーラーの勝ち！' . PHP_EOL;
                } else {
                    echo 'あなたの現在の得点は' . $this->resultPlayerScores . 'です。カードを引きますか？（Y/N）';
                    $this->yesOrNo = trim(fgets(STDIN));
                }
            }

        }

        // 合計値 < 17 の間は、ディーラーは カードを1枚引き続ける
        while($this->resultDealerScores < 17) {
            $dealerDrawOneCard = $drawOneCard->drawOneCard($deck);

            echo 'ディーラーが引いた1枚のカードは、' . $dealerDrawOneCard[0] . 'の' . $dealerDrawOneCard[1] . 'です。' . PHP_EOL;

            $this->resultDealerScores = $calScore->calScore($dealerDrawOneCard[1], $this->resultDealerScores);
        }

        if ($this->resultDealerScores > $blackJackNumber) {
            echo 'プレイヤーの勝ち！';
        } else {
            if ($this->resultDealerScores > $this->resultPlayerScores) {
                echo 'ディーラーの勝ち！';
            } elseif ($this->resultDealerScores < $this->resultPlayerScores) {
                echo 'プレイヤーの勝ち！';
            } elseif ($this->resultDealerScores === $this->resultPlayerScores) {
                echo '引き分け';
            }
        }
    }
}
