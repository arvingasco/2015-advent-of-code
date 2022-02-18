<?php

$dayNine = new DayNineAdvent();
$dayNine->challenge();

class DayNineAdvent
{
    function challenge()
    {
        $cities = [];
        $totalPermDists = [];
        $cityDistances = [];

        foreach ($this->fileData() as $line) {
            $array = explode(' ', $line);
            $source = $array[0];
            $destination = $array[2];
            $distance = intval($array[4]);

            $cities[] = $source;
            $cities[] = $destination;

            if (isset($cityDistances[$source]) === false) {
                $cityDistances[$source] = [];
            }
            if (isset($cityDistances[$source]) === false) {
                $cityDistances[$destination] = [];
            }
            $cityDistances[$source][$destination] = $cityDistances[$destination][$source] = $distance;
        }

        $routePermutations = $this->computePermutations(array_values(array_unique($cities)));

        foreach ($routePermutations as $permutation) {
            $totalDistance = 0;
            for ($i = 0; $i < count($permutation) - 1; $i++) {
                $totalDistance += $cityDistances[$permutation[$i]][$permutation[$i + 1]];
            }

            $totalPermDists[] = $totalDistance;
        }

        echo 'Minimum distance = ' . min($totalPermDists) . '<br>';
        echo 'Maximum distance = ' . max($totalPermDists) . '<br>';
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

        if (!$file)
            die('file does not exist or cannot be opened');

        while (($line = fgets($file)) !== false) {
            yield $line;
        }

        fclose($file);
    }
}