<?php
ini_set('memory_limit', '-1');

$dayTen = new DayTenAdvent();
/**
 *  Only run challenge method once! It takes up a LOT of memory!
 */
echo 'String length after 40 iterations = ' . $dayTen->challenge(40) . '<br>';
echo 'String length after 50 iterations = ' . $dayTen->challenge(50);

class DayTenAdvent
{
    function challenge($iterations): int
    {
        $input = '3113322113';

        for ($n = 1; $n <= $iterations; $n++) {
            $input = $this->lookAndSay($input);
        }

        return strlen(trim($input));
    }

    function lookAndSay($input): string
    {
        preg_match_all('/(.)\1*/', $input, $matches);
        $numbers = $matches[0];

        $i = 0;
        foreach ($numbers as $number) {
            $quantity = strlen($number);

            for ($j = 0; $j <= 3; $j++) {
                if (str_contains($number, strval($j)) === true) {
                    $numbers[$i] = $quantity . $j;
                }
            }

            $i += 1;
        }

        return implode('', $numbers);
    }

}