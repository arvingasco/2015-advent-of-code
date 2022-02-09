<?php

$dayEight = new DayEightAdvent();
echo $dayEight->partOne();
echo '<br>';
echo $dayEight->partTwo();

class DayEightAdvent
{
    function partOne()
    {
        $totalLiteralChar = 0;
        $totalStringChar = 0;

        foreach ($this->fileData() as $line) {
            $stringLiteral = trim($line);
            $totalLiteralChar += (strlen($stringLiteral));

            $string = ltrim($stringLiteral, '"');
            $string = substr($string, 0, -1);
            $string = preg_replace('/\\\x[a-f0-9]{2}/', '@', $string);
            $string = preg_replace('/\\\\\"/', '"', $string);
            $string = preg_replace('/\\\\\\\\/', '\\', $string);

            $totalStringChar += (strlen($string));
        }
        return $totalLiteralChar - $totalStringChar;
    }

    function partTwo()
    {
        $totalLiteralChar = 0;
        $totalEncodedChar = 0;

        foreach ($this->fileData() as $line) {
            $stringLiteral = trim($line);
            $totalLiteralChar += (strlen($stringLiteral));

            $characters = str_split($stringLiteral);
            foreach ($characters as $character) {
                if ($character === '"' || $character === '\\') {
                    $totalEncodedChar += 2;
                } else {
                    $totalEncodedChar += 1;
                }
            }
            $totalEncodedChar += 2;
        }
        return $totalEncodedChar - $totalLiteralChar;
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