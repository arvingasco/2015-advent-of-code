<?php

$day13 = new Day13Advent();
echo 'The optimum happiness value is ' . $day13->partOne();

class Day13Advent
{
    function partOne(): int
    {
        $people = $adjacentPeople = $rawHappiness = $happinessArray = [];

        foreach ($this->fileData() as $line) {
            $lineArray = explode(' ', $line);

            $people[] = $lineArray[0];
            $adjacentPeople[] = $lineArray[0] . rtrim(trim($lineArray[10]), '.');

            if ($lineArray[2] === 'gain') {
                $rawHappiness[] = floatval($lineArray[3]);
            } else {
                $rawHappiness[] = floatval(-$lineArray[3]);
            }
        }

        $people = array_values(array_unique($people));

        $permutations = $this->computePermutations($people);

        foreach ($permutations as $permutation) {
            $i = $happiness = 0;
            foreach ($permutation as $person) {
                $currentPerson = $person;

                if ($i === 0) {
                    $key1 = array_search($currentPerson . end($permutation), $adjacentPeople);
                    $key2 = array_search(end($permutation) . $currentPerson, $adjacentPeople);
                } else {
                    $key1 = array_search($previousPerson . $currentPerson, $adjacentPeople);
                    $key2 = array_search($currentPerson . $previousPerson, $adjacentPeople);
                }

                $happiness += $rawHappiness[$key1];
                $happiness += $rawHappiness[$key2];

                $previousPerson = $person;
                $i++;
            }
            $previousPerson =  $currentPerson = null;
            $happinessArray[] = $happiness;
        }

        return max($happinessArray);
    }

    function computePermutations($array): array
    {
        $permutations = [];

        $recurse = function($array, $initial = 0) use (&$permutations, &$recurse) {
            if ($initial === count($array) - 1) {
                $permutations[] = $array;
            }

            for ($i = $initial; $i < count($array); $i++) {
                $dummy = $array[$i];
                $array[$i] = $array[$initial];
                $array[$initial] = $dummy;


                $recurse($array, $initial + 1);

                $dummy = $array[$i];
                $array[$i] = $array[$initial];
                $array[$initial] = $dummy;
            }
        };

        $recurse($array);

        return $permutations;
    }

    /**
     * @return Generator
     */
    function fileData(): Generator
    {
        $file = fopen('input.txt', 'r');

        if (!$file) {
            die('file does not exist or cannot be opened');
        }

        while (($line = fgets($file)) !== false) {
            yield $line;
        }

        fclose($file);
    }
}