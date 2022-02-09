<?php

$dayEight = new DayEightAdvent();
//echo $dayEight->partOne();
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

            $string = preg_replace('/\\\x[a-f0-9]{2}/', '@', $stringLiteral);

            $characters = str_split($string);
            $i = 0;
            foreach ($characters as $character) {
                $totalEncodedChar += 1;

                if ($character === '"' && $i === 0) {
                    $totalEncodedChar += 2;
                } else if ($character === '"' && $i === count($characters) - 1) {
                    $totalEncodedChar += 2;
                } else if ($character === '@') {
                    $totalEncodedChar += 4;
                } else if ($character === '\\') {
                    $totalEncodedChar += 2;
                }

                $i += 1;
            }
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