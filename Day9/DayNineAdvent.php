<?php

$dayNine = new DayNineAdvent();
$dayNine->partOne();

class DayNineAdvent
{
    function partOne()
    {

    }

    /**
     * @return Generator
     */
    function fileData(): Generator
    {
        $file = fopen('input.txt', 'r');

        if (!$file)
            die('file does not exist or cannot be opened');

        while (($line = fgets($file)) !== false) {
            yield $line;
        }

        fclose($file);
    }
}