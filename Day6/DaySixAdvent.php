<?php

$daySix = new DaySixAdvent();
echo $daySix->partOne();

class DaySixAdvent 
{
    function partOne()
    {
        $adventFile = $this->readFile();

        $count = 0;
        while (($line = fgets($adventFile)) !== false) {
            $value = filter_var($line, FILTER_SANITIZE_NUMBER_INT);
            return $value;
        }

        return $count;
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