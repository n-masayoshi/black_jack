<?php

require_once('BJFirstTurn.php');
require_once('BJYesOrNo.php');
require_once('BJDealer.php');

class BJGame
{
    private array $playerDeck;
    private array $dealerDeck;
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
        $this->playerDeck = $resultFirstTurn[0];
        $this->dealerDeck = $resultFirstTurn[1];
        $this->resultPlayerScores = $resultFirstTurn[2];
        $this->resultDealerScores = $resultFirstTurn[3];

        $blackJackNumber = 21;
        // $player ターン
        $this->yesOrNo = trim(fgets(STDIN));
        if ($this->yesOrNo === 'y' || $this->yesOrNo === 'Y') {
            do {
                $judge = new BJYesOrNo();
                $resultPlayerTurn = $judge->yesOrNo($this->playerDeck, $this->resultPlayerScores);
                $this->resultPlayerScores = $resultPlayerTurn[0];
                $newCard = $resultPlayerTurn[1];
                $this->playerDeck[] = $newCard[1];

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

        // $dealer ターン && 最終結果
        $dealerTurn = new BJDealer();
        $dealerTurn->dealerTurn($this->resultDealerScores, $this->resultPlayerScores, $this->dealerDeck);
    }
}
