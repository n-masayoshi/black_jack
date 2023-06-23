<?php

class BJDeck
{
    private array $deck;

    public function makeDeck(): array
    {
        foreach(['C', 'H', 'S', 'D'] as $suit) {
            foreach(range(1, 13) as $number) {
                if ($number <= 10) {
                    $this->deck[] = [$suit, $number];
                } else {
                    $this->deck[] = [$suit, 10];
                }

            }
        }
        return $this->deck;
    }

    public function getTwoCards(): array
    {
        $randomKeys = array_rand($this->deck, 2);
        $twoCards = [];
        foreach ($randomKeys as $key) {
            $twoCards[] = $this->deck[$key];
        }
        return $twoCards;
    }
}
