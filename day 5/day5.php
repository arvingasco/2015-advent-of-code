<?php

$dayFive = new DayFiveAdvent();
echo 'There are ' . $dayFive->partOne() . ' nice strings.';
echo '<br>';
echo 'There are ' . $dayFive->partTwo() . ' nice strings.';

class DayFiveAdvent
{
    function partOne(): int
    {
        $adventFile = $this->readFile();

        $count = 0;
        while (($line = fgets($adventFile)) !== false) {
            if ($this->countVowels($line) < 3) {
                continue;
            }

            if ($this->hasDoubleLetter($line) === false) {
                continue;
            }

            if ($this->hasNaughtyString($line) === true) {
                continue;
            }
            $count += 1;
        }

        return $count;
    }

    function partTwo(): int
    {
        $adventFile = $this->readFile();

        $count = 0;
        while (($line = fgets($adventFile)) !== false) {
            if (preg_match('/(..).*\1/', $line) === 0) {
                continue;
            }

            if (preg_match('/(.).\1/', $line) === 0) {
                continue;
            }

            $count += 1;
        }

        return $count;
    }

    function countVowels($string): int
    {
        return substr_count($string, 'a') + substr_count($string, 'e') + substr_count($string, 'i')
            + substr_count($string, 'o') + substr_count($string, 'u');
    }

    function hasDoubleLetter($string): bool
    {
        $stringArray = str_split($string);
        $previousCharacter = '';
        foreach ($stringArray as $character) {
            $currentCharacter = $character;

            if ($previousCharacter === $currentCharacter) {
                return true;
            }

            $previousCharacter = $character;
        }
        return false;
    }

    function hasNaughtyString($string): bool
    {
        if (strpos($string, 'ab') || strpos($string, 'cd') || strpos($string, 'pq') || strpos($string, 'xy')) {
            return true;
        }
        return false;
    }

    function readFile()
    {
        $file = fopen('input.txt', 'r');

        if (!$file) {
            echo 'Error opening file.';
            return null;
        }

        return $file;
    }
}