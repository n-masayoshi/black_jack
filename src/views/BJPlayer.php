<?php

require_once('BJDeck.php');
require_once('BJDrawOneCard.php');
require_once('BJCalScore.php');
require_once('BJDisplayFormDrawCardOrNot.php');


class BJPlayer
{
    function playerTurn
    (
        int $resultPlayerScores, array $playerDeck, int $resultDealerScores, array $dealerDeck
    ): void
    {
        // 52枚のデッキの作成
        $BJdeck = new BJDeck();
        $deck = $BJdeck->makeDeck();
        // カードを1枚 引く
        $drawOneCard = new BJDrawOneCard();
        $playerDrawOneCard = $drawOneCard->drawOneCard($deck);
        // $playerDeck に カードの数値を格納
        $playerDeck[] = $playerDrawOneCard[1];
        // 手札の合計値の計算
        $calScore = new BJCalScore();
        $resultPlayerScores = $calScore->calculateScore($playerDeck);
        // $resultDrawOneCard = $judge->yesOrNo($playerDeck, $resultPlayerScores);

        // $resultPlayerScores = $resultDrawOneCard[0];
        // $newCard = $resultDrawOneCard[1];
        // $playerDeck[] = $newCard[1];
        echo 'あなたが引いた1枚のカードは、' . $playerDrawOneCard[0] . 'の' . $playerDrawOneCard[1] . 'です。<br>';

        $blackJackNumber = 21;
        if ($resultPlayerScores > $blackJackNumber) {
            echo 'ディーラーの得点は' . $resultDealerScores . 'です。<br>';
            echo 'ディーラーの勝ち！<br>';
            die();
        }

        echo 'あなたの現在の得点は' . $resultPlayerScores . 'です。カードを引きますか？（Y/N）';
        $displayForm = new BJDisplayFormDrawCardOrNot();
        $displayForm->displayFormDrawCardOrNot();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 最大で9回、カードを引く可能性がある。
            $count = 1;
            // フォームからの選択肢を取得
            $yesOrNo = $_POST['choice'];
            // 選択肢に基づいてゲームのロジックを実行
            while($count < 9 && $yesOrNo === 'Y') {
                echo 'あなたの現在の得点は' . $resultPlayerScores . 'です。カードを引きますか？（Y/N）';
                $displayForm->displayFormDrawCardOrNot();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // フォームからの選択肢を取得
                    $yesOrNo = $_POST['choice'];
                }
                $count++;
                echo $count;
            }
            $dealer = new BJDealer();
            $dealer->dealerTurn($resultDealerScores, $dealerDeck, $resultPlayerScores);
        }
    }
}
