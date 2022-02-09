<?php

$dayFour = new DayFourAdvent();
echo $dayFour->partOne();
echo '<br>';
echo $dayFour->partTwo();

class DayFourAdvent
{
    function partOne(): string
    {
        $adventFile = $this->readFile();
        $puzzleInput = fgets($adventFile);

        $hexadecimal = 0;
        $needle = '00000';
        while (!str_starts_with(md5($puzzleInput . $hexadecimal), $needle))
            $hexadecimal += 1;
        return $hexadecimal;
    }

    function partTwo(): string
    {
        $adventFile = $this->readFile();
        $puzzleInput = fgets($adventFile);

        $hexadecimal = 0;
        $needle = '000000';
        while (!str_starts_with(md5($puzzleInput . $hexadecimal), $needle))
            $hexadecimal += 1;
        return $hexadecimal;
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