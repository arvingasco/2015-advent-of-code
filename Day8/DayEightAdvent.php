<?php

$dayEight = new DayEightAdvent();
echo $dayEight->partOne();

class DayEightAdvent
{
    function partOne()
    {
        $strings = [];
        $totalLiteralChar = 0;
        $totalStringChar = 0;

        foreach ($this->fileData() as $line) {
            $stringLiteral = trim($line);
            $totalLiteralChar += (strlen($stringLiteral));
//            echo $stringLiteral;
//            echo ' current string length ' . strlen($stringLiteral) . '<br>';
//            echo 'literal total ' . $totalLiteralChar . ' <br>';

            $string = trim($stringLiteral);
            $string = ltrim($string, '"');
            $string = substr($string, 0, -1);

            $string = preg_replace('/\\\x[a-f0-9]{2}/', '@', $string);
            $string = preg_replace('/\\\\\"/', '"', $string);
            $string = preg_replace('/\\\\\\\\/', '\\', $string);

            $totalStringChar += (strlen($string));
//            echo '"' . $string . '"';
//            echo ' current string length ' . strlen($string) . '<br>';
//            echo 'string total ' . $totalStringChar . ' <br>';
            $strings[] = $string;
        }
//        foreach ($strings as $string) {
//            echo $string . '<br>';
//        }
        return $totalLiteralChar - $totalStringChar;
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