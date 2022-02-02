<?php
set_time_limit(0); //If set to zero, no time limit is imposed.

$dayFour = new DayFourAdvent();
echo $dayFour->challenge();

class DayFourAdvent extends FileRead
{
    function challenge(): string
    {
        $adventFile = $this->readFile();
        $puzzleInput = fgets($adventFile);

        $hexadecimal = 0;
        $needle = '000000';
        while (!str_starts_with(md5($puzzleInput . $hexadecimal), $needle))
            $hexadecimal += 1;
        return $hexadecimal;
    }
}