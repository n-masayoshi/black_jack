<?php

class BJDrawOneCard
{
    public function drawOneCard(array $deck): array
    {
        $randomKeys = array_rand($deck);
        $oneCard = $deck[$randomKeys];
        return $oneCard;
    }
}
