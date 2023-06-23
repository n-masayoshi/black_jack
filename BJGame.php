<?php

require_once('BJFirstTurn.php');
require_once('BJYesOrNo.php');
require_once('BJDealer.php');

class BJGame
{
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
        // 初回のターン
        $firstTurn = new BJFirstTurn();
        $resultFirstTurn = $firstTurn->firstTurn();
        $playerDeck = $resultFirstTurn[0];
        $dealerDeck = $resultFirstTurn[1];
        $this->resultPlayerScores = $resultFirstTurn[2];
        $this->resultDealerScores = $resultFirstTurn[3];

        $blackJackNumber = 21;
        // 2ターン目
        $this->yesOrNo = trim(fgets(STDIN));
        if ($this->yesOrNo === 'y' || $this->yesOrNo === 'Y') {
            do {
                $judge = new BJYesOrNo();
                $resultYesOrNo = $judge->yesOrNo($playerDeck, $this->resultPlayerScores);
                $this->resultPlayerScores = $resultYesOrNo[0];
                $newCard = $resultYesOrNo[1];
                $playerDeck[] = $newCard[1];

                echo 'あなたが引いた1枚のカードは、' . $newCard[0] . 'の' . $newCard[1] . 'です。' . PHP_EOL;

                if ($this->resultPlayerScores > $blackJackNumber) {
                    echo 'ディーラーの得点は' . $this->resultDealerScores . 'です。' . PHP_EOL;
                    echo 'ディーラーの勝ち！';
                    die();
                }
                echo 'あなたの現在の得点は' . $this->resultPlayerScores . 'です。カードを引きますか？（Y/N）';
                $this->yesOrNo = trim(fgets(STDIN));
            } while($this->yesOrNo === 'y' || $this->yesOrNo === 'Y');
        }

        // ディラーのターン && 最終結果
        $dealerTurn = new BJDealer();
        $dealerTurn->dealerTurn($this->resultDealerScores, $this->resultPlayerScores, $dealerDeck);
    }
}
