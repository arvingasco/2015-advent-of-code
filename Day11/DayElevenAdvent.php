<?php
ini_set('max_execution_time', 0);

$day11 = new DayElevenAdvent();
echo 'Santa\'s new password is ' . $day11->partOne();

class DayElevenAdvent
{
    function partOne(): string
    {
        $input = 'vzbxkghb';

        $valid = 0;
        while ($valid !== 3) {
            $valid = 0;

            if ($this->hasStraight($input) === false) {
                $input++;
                continue;
            }
            $valid += 1;

            if ($this->hasIOL($input) === true) {
                $input++;
                continue;
            }
            $valid += 1;

            if ($this->followsRuleThree($input) === false) {
                $input++;
                continue;
            }
            $valid += 1;
        }

        return $input;
    }

    function hasStraight($string): bool
    {
        $straight = 0;
        foreach (str_split($string) as $character) {
            $currentCharacter = $character;

            if (!isset($previousCharacter)) {
                $previousCharacter = $character;
                continue;
            }

            $previousCharacter++;
            if ($currentCharacter === $previousCharacter) {
                $straight += 1;
            } else {
                $straight = 0;
            }

            if ($straight >= 2) {
                return true;
            }

            $previousCharacter = $character;
        }
        return false;
    }

    function hasIOL($string): bool
    {
        preg_match('/[iol]/', $string, $matchTwo);
        if ($matchTwo) {
            return true;
        }
        return false;
    }

    function followsRuleThree($input): bool
    {
        preg_match_all('/([a-z])\1/', $input, $matchThree);
        if (empty($matchThree[0]) === true || count($matchThree[0]) < 2) {
            return false;
        }

        foreach ($matchThree[0] as $string) {
            if (substr_count($input, $string) > 1) {
                return false;
            }
        }
        return true;
    }
}