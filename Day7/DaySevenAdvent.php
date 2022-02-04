<?php

$daySeven = new DaySevenAdvent();
echo json_encode($daySeven->partOne());

class DaySevenAdvent
{
    function partOne()
    {
        foreach ($this->fileData() as $line) {
            $lineArray = preg_split('/\s+/', $line);
            return $lineArray;
        }
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