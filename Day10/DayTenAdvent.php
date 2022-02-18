<?php

$dayTen = new DayTenAdvent();
echo 'String length after 40 iterations = ' . $dayTen->partOne();

class DayTenAdvent
{
    function partOne()
    {
        $input = 3113322113;

        for ($n = 0; $n <= 40; $n++) {
            $input = $this->lookAndSay($input);
        }

        return strlen(trim($input));
    }

    function lookAndSay($input)
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