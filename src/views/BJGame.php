<?php

require_once('BJDeck.php');
require_once('BJCalFirstTurnScore.php');
require_once('BJDisplayFormDrawCardOrNot.php');
require_once('BJPlayer.php');
require_once('BJDealer.php');
// require_once('BJYesOrNo.php');
// require_once('BJDrawOneCard.php');
// require_once('BJCalScore.php');

class BJGame
{
    private array $playerTwoCards;
    private array $dealerTwoCards;
    private int $resultPlayerScores;
    private int $resultDealerScores;
    private array $playerDeck;
    private array $dealerDeck;
    private string $yesOrNo;

    public function __construct() { }

    // public function start()
    // {
    //     echo 'hello PHP';
    // }
    public function start()
    {
        echo 'ブラックジャックを開始します。<br>';
        $BJdeck = new BJDeck();
        $deck = $BJdeck->makeDeck();

        for ($i = 0; $i < 2; $i++) {
            $twoCards = $BJdeck->getTwoCards();
            if ($i === 0) {
                $this->playerTwoCards = $twoCards;
                $playerFirstCard = $this->playerTwoCards[0];
                $playerSecondCard = $this->playerTwoCards[1];

                // $playerDeck に 2枚のカードの数値を格納
                $this->playerDeck[] = $playerFirstCard[1];
                $this->playerDeck[] = $playerSecondCard[1];

                echo 'あなたの1枚目のカードは、' . $playerFirstCard[0] . 'の' . $playerFirstCard[1] . 'です。<br>';

                echo 'あなたの2枚目のカードは、' . $playerSecondCard[0] . 'の' .$playerSecondCard[1] . 'です。<br>';
            } else {
                $this->dealerTwoCards =$twoCards;
                $dealerFirstCard = $this->dealerTwoCards[0];
                $dealerSecondCard = $this->dealerTwoCards[1];

                // $dealerDeck に それぞれのカードの数値を格納
                $this->dealerDeck[] = $dealerFirstCard[1];
                $this->dealerDeck[] = $dealerSecondCard[1];

                echo 'ディーラーの1枚目のカードは、' . $dealerFirstCard[0] . 'の' . $dealerFirstCard[1] . 'です。<br>';
                echo 'ディーラーの引いた2枚目のカードはわかりません。<br>';
            }
        }
        // 最初のターン：$player, $dealer 各々の最初の2枚の合計値
        $calFirstTurnScore = new FirstTurnScore();

        // プレイヤーの １回目のターンの合計値
        $this->resultPlayerScores = $calFirstTurnScore->calFirstTurnScore($this->playerTwoCards);

        // ディーラーの １回目のターンの合計値
        $this->resultDealerScores = $calFirstTurnScore->calFirstTurnScore($this->dealerTwoCards);

        $blackJackNumber = 21;
        // 最初に合計値が、決まるのは プレイヤー
        echo 'あなたの現在の得点は' . $this->resultPlayerScores . 'です。カードを引きますか？';
        $displayForm = new BJDisplayFormDrawCardOrNot();
        $displayForm->displayFormDrawCardOrNot();

        // フォームが送信された場合の処理
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // フォームからの選択肢を取得
            $yesOrNo = $_POST['choice'];

            // 選択肢に基づいてゲームのロジックを実行
            if ($yesOrNo === 'Y') {

                $player = new BJPlayer();
                $player->playerTurn($this->resultPlayerScores, $this->playerDeck, $this->resultPlayerScores, $this->dealerDeck,);

                // // カードを引く処理
                // $judge = new BJYesOrNo();
                // $resultYesOrNo = $judge->yesOrNo($this->playerDeck, $this->resultPlayerScores);

                // $this->resultPlayerScores = $resultYesOrNo[0];
                // $newCard = $resultYesOrNo[1];
                // $this->playerDeck[] = $newCard[1];

                // echo 'あなたが引いた1枚のカードは、' . $newCard[0] . 'の' . $newCard[1] . 'です。<br>';

                // if ($this->resultPlayerScores > $blackJackNumber) {
                //     echo 'ディーラーの得点は' . $this->resultDealerScores . 'です。<br>';
                //     echo 'ディーラーの勝ち！<br>';
                //     die();
                // }
                // echo 'あなたの現在の得点は' . $this->resultPlayerScores . 'です。カードを引きますか？（Y/N）';
                // $displayForm->displayFormDrawCardOrNot();
            } else {
                $dealer = new BJDealer();
                $dealer->dealerTurn($this->resultDealerScores, $this->dealerDeck, $this->resultPlayerScores);
            }
        }

        // $this->yesOrNo = trim(fgets(STDIN));
        // if ($this->yesOrNo === 'y' || $this->yesOrNo === 'Y') {
            // do {
            //     $judge = new BJYesOrNo();
            //     $resultYesOrNo = $judge->yesOrNo($this->playerDeck, $this->resultPlayerScores);
            //     $this->resultPlayerScores = $resultYesOrNo[0];
            //     $newCard = $resultYesOrNo[1];
            //     $this->playerDeck[] = $newCard[1];

            //     echo 'あなたが引いた1枚のカードは、' . $newCard[0] . 'の' . $newCard[1] . 'です。<br>';

            //     if ($this->resultPlayerScores > $blackJackNumber) {
            //         echo 'ディーラーの得点は' . $this->resultDealerScores . 'です。<br>';
            //         echo 'ディーラーの勝ち！<br>';
            //         die();
            //     }
            //     echo 'あなたの現在の得点は' . $this->resultPlayerScores . 'です。カードを引きますか？（Y/N）';
            //     $this->yesOrNo = trim(fgets(STDIN));
            // } while($this->yesOrNo === 'y' || $this->yesOrNo === 'Y');
        // }

        // $drawOneCard = new BJDrawOneCard();
        // $calScore = new BJCalScore();
        // // 合計値 < 17 の間は、ディーラーは カードを1枚引き続ける
        // while($this->resultDealerScores < 17) {
        //     $dealerDrawOneCard = $drawOneCard->drawOneCard($deck);

        //     echo 'ディーラーが引いた1枚のカードは、' . $dealerDrawOneCard[0] . 'の' . $dealerDrawOneCard[1] . 'です。<br>';

        //     $this->dealerDeck[] = $dealerDrawOneCard[1];

        //     $this->resultDealerScores = $calScore->calculateScore($this->dealerDeck);
        // }

        // if ($this->resultDealerScores > $blackJackNumber) {
        //     echo 'ディーラーの得点は' . $this->resultDealerScores . 'です。<br>';
        //     echo 'プレイヤーの勝ち！<br>';
        // } else {
        //     if ($this->resultDealerScores > $this->resultPlayerScores) {
        //         echo 'ディーラーの得点は' . $this->resultDealerScores . 'です。<br>';
        //         echo 'ディーラーの勝ち！<br>';
        //     } elseif ($this->resultDealerScores < $this->resultPlayerScores) {
        //         echo 'ディーラーの得点は' . $this->resultDealerScores . 'です。<br>';
        //         echo 'プレイヤーの勝ち！<br>';
        //     } elseif ($this->resultDealerScores === $this->resultPlayerScores) {
        //         echo 'ディーラーの得点は' . $this->resultDealerScores . 'です。<br>';
        //         echo '引き分け<br>';
        //     }
        // }
    }
}
