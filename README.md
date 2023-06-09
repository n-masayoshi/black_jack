# ターミナルで動作する、Black_Jackゲームの作成
## はじめに
- プログラミング学習サービス、独学エンジニアの課題です。
- 課題目標：オブジェクト指向プログラミングを実践すること。

## 完成までのステップ

- [x] ステップ1：ターミナルで実行する。
- 実行開始時、プレイヤーとディーラーはそれぞれ、カードを2枚引く。引いたカードは画面に表示する。
  - ただし、ディーラーの2枚目のカードは分からないようにする
- その後、先にプレイヤーがカードを引く。プレイヤーのカードの合計値が21を超えたらプレイヤーの負け
- プレイヤーはカードを引くたびに次のカードを引くか選択できる
- プレイヤーがカードを引き終えたら、ディーラーは自分のカードの合計値が17以上になるまで引き続ける
- ディーラーは、CPUが自動で操作する
- プレイヤーとディーラーが引き終えたら勝負。カードの合計値が21により近い方が勝ち
- Aは1点として取り扱う

- [x] ステップ2
  - A(エース)を1点あるいは11点のどちらかで扱うように、プログラムを修正する。
    - Aは、カードの合計値が21以内で最大となる方で、数えるようにします。

- [ ] ステップ3
  - 最大3人までのプレイヤーでプレイできるようにしましょう（ディーラーと合わせて合計4人）。増えたプレイヤーはCPUが自動的に操作します。

## 次、やること

1. もう少しコードを簡略できるか考える
2. オブジェクト指向をもう少し深掘りする
3. デッキ($deck)を常に使い回すこと。
    - 現状だと、同じカードを複数手札にもつ可能性がある。また、全てのプレイヤーが同じカードを持つことが可能だから。
5. プレイヤーのターンの処理をクラス化する。
    - BJGame.phpファイルから、移植する。

# Black Jack ゲーム　現状確認

```
1.
# 何回も「カードを引く」動作が機能するかの確認

ブラックジャックを開始します。
あなたの1枚目のカードは、Dの2です。
あなたの2枚目のカードは、Dの9です。
ディーラーの1枚目のカードは、Sの9です。
ディーラーの引いた2枚目のカードはわかりません。
あなたの現在の得点は11です。  　　　　　※補足：この時、自分が持っているデッキの中身は、[2,9]
ディーラーの現在の得点は17です。  ※補足：確認しやすいように、ディーラーの得点も表示している。
あなたの現在の得点は11です。カードを引きますか？（Y/N）y
あなたの現在の得点は13です。　　　　　　　　　※補足：この時、自分が持っているデッキの中身は、[1,1,1]-> 11 + 1 + 1 = 13。テスト目的で、2回目のカード引きから、deck　が、全て 1 になるようにしている。
あなたの現在の得点は13です。カードを引きますか？（Y/N）y
あなたの現在の得点は14です。
あなたの現在の得点は14です。カードを引きますか？（Y/N）y
あなたの現在の得点は15です。
あなたの現在の得点は15です。カードを引きますか？（Y/N）y
あなたの現在の得点は16です。
あなたの現在の得点は16です。カードを引きますか？（Y/N）y
あなたの現在の得点は17です。
あなたの現在の得点は17です。カードを引きますか？（Y/N）n
引き分け

---
2.
# 1.の動作の上、ちゃんと勝敗のロジックが、機能しているかの確認

ブラックジャックを開始します。
あなたの1枚目のカードは、Hの7です。
あなたの2枚目のカードは、Sの10です。
ディーラーの1枚目のカードは、Sの9です。
ディーラーの引いた2枚目のカードはわかりません。
あなたの現在の得点は17です。
ディーラーの現在の得点は18です。
あなたの現在の得点は17です。カードを引きますか？（Y/N）y
あなたの現在の得点は13です。※補足：この時、自分が持っているデッキの中身は、[1,1,1]-> 11 + 1 + 1 = 13。テスト目的で、2回目のカード引きから、deck　が、全て 1 になるようにしている。
あなたの現在の得点は13です。カードを引きますか？（Y/N）y
あなたの現在の得点は14です。
あなたの現在の得点は14です。カードを引きますか？（Y/N）y
あなたの現在の得点は15です。
あなたの現在の得点は15です。カードを引きますか？（Y/N）y
あなたの現在の得点は16です。
あなたの現在の得点は16です。カードを引きますか？（Y/N）y
あなたの現在の得点は17です。
あなたの現在の得点は17です。カードを引きますか？（Y/N）y
あなたの現在の得点は18です。
あなたの現在の得点は18です。カードを引きますか？（Y/N）y
あなたの現在の得点は19です。
あなたの現在の得点は19です。カードを引きますか？（Y/N）y
あなたの現在の得点は20です。
あなたの現在の得点は20です。カードを引きますか？（Y/N）y
あなたの現在の得点は21です。
あなたの現在の得点は21です。カードを引きますか？（Y/N）n
プレイヤーの勝ち！

---
3.
# A(エース)が、「11」として機能しているのかの確認

ブラックジャックを開始します。
あなたの1枚目のカードは、Sの1です。
あなたの2枚目のカードは、Dの5です。
ディーラーの1枚目のカードは、Hの7です。
ディーラーの引いた2枚目のカードはわかりません。
あなたの現在の得点は16です。
ディーラーの現在の得点は17です。
あなたの現在の得点は16です。カードを引きますか？（Y/N）y
あなたが引いた1枚のカードは、Hの5です。
あなたの現在の得点は21です。カードを引きますか？（Y/N）n
プレイヤーの勝ち！

---
4.
# 途中で、A(エース)を引いても、Aのルールが適用されているかの確認

ブラックジャックを開始します。
あなたの1枚目のカードは、Hの3です。
あなたの2枚目のカードは、Dの2です。
ディーラーの1枚目のカードは、Cの10です。
ディーラーの引いた2枚目のカードはわかりません。
あなたの現在の得点は5です。カードを引きますか？（Y/N）y
あなたが引いた1枚のカードは、Cの8です。
あなたの現在の得点は13です。カードを引きますか？（Y/N）y
あなたが引いた1枚のカードは、Cの1です。
あなたの現在の得点は14です。カードを引きますか？（Y/N）y
あなたが引いた1枚のカードは、Cの7です。
あなたの現在の得点は21です。カードを引きますか？（Y/N）n
ディーラーが引いた1枚のカードは、Dの10です。
ディーラーの得点は26です。
プレイヤーの勝ち！

---
5.
# 単純に、ゲームとして機能しているかの確認
# 勿論、ディーラーの2枚目のカードを伏せている

ブラックジャックを開始します。
あなたの1枚目のカードは、Sの9です。
あなたの2枚目のカードは、Dの4です。
ディーラーの1枚目のカードは、Hの1です。
ディーラーの引いた2枚目のカードはわかりません。
あなたの現在の得点は13です。カードを引きますか？（Y/N）y
あなたが引いた1枚のカードは、Dの8です。
あなたの現在の得点は21です。カードを引きますか？（Y/N）n
ディーラーの得点は21です。
引き分け
```
