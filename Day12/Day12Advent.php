<?php

$day12 = new Day12Advent();

echo 'The sum of all the numbers (part one) is ' . $day12->partOne() . '.<br>';

$file = fopen('input.json', 'r');
$json = fgets($file);
fclose($file);
$json = json_decode($json);

echo 'The sum of all the numbers (part two) is ' . $day12->partTwo($json) . '.<br>';


class Day12Advent
{
    function partOne(): int
    {
        $file = fopen('input.json', 'r');
        $json = fgets($file);
        fclose($file);

        preg_match_all('/[-0-9]+/', $json, $numbers);

        return array_sum($numbers[0]);
    }

    function partTwo($json): int|string|null
    {
        $sum = 0;

        foreach($json as $part) {
            if(is_array($part) || is_object($part)) {
                $sum += $this->partTwo($part);
            }

            if(is_numeric($part)) {
                $sum += $part;
            }

            if(is_object($json) && is_string($part) && $part == "red") {
                return null;
            }
        }

        return $sum;
    }
}