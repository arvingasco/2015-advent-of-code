<?php

$day12 = new Day12Advent();
echo 'The sum of all the numbers is ' . $day12->partOne() . '.<br>';

class Day12Advent
{
    function partOne(): int
    {
        $file = fopen('input.json', 'r');
        $json = fgets($file);

        preg_match_all('/[-0-9]+/', $json, $numbers);

        return array_sum($numbers[0]);
    }
}