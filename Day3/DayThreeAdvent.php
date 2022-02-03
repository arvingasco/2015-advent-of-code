<?php

$dayThree = new DayThreeAdvent();
echo 'Santa visits ' . count($dayThree->getSantaUniqueHouses()) . ' uniques houses.';
echo '<br>';
echo 'Santa and robosanta visits ' . count($dayThree->getTotalUniqueHouses()) . ' unique houses';

class DayThreeAdvent
{
    function getSantaUniqueHouses()
    {
        $adventFile = $this->readFile();
        $puzzleInput = fgets($adventFile);
        fclose($adventFile);

        $characters = str_split($puzzleInput);
        $houseCoordinates = $this->getSantaCoordinates($characters);

        if (!is_array($houseCoordinates)) {
            echo 'Unexpected Santa error.';
            return null;
        }

        return array_unique($houseCoordinates, SORT_REGULAR);
    }

    function getTotalUniqueHouses()
    {
        $adventFile = $this->readFile();
        $puzzleInput = fgets($adventFile);
        fclose($adventFile);

        $characters = str_split($puzzleInput);

        $santaArray = [];
        $roboSantaArray = [];
        $index = 0;
        foreach ($characters as $character) {
            if ($this->isEven($index) === true) {
                $santaArray[] = $character;
            } else {
                $roboSantaArray[] = $character;
            }
            $index += 1;
        }

        $santaHouseCoordinates = $this->getSantaCoordinates($santaArray);
        $roboSantaHouseCoordinates = $this->getSantaCoordinates($roboSantaArray);
        $houseCoordinates = array_merge($santaHouseCoordinates, $roboSantaHouseCoordinates);

        if (!is_array($houseCoordinates)) {
            echo 'Unexpected Santa error.';
            return null;
        }

        return array_unique($houseCoordinates, SORT_REGULAR);
    }


    function getSantaCoordinates($characters)
    {
        $x = 0;
        $y = 0;
        foreach ($characters as $character) {
            if ($character === '>') {
                $x += 1;
            } else if ($character === '<') {
                $x -= 1;
            } else if ($character === '^') {
                $y += 1;
            } else {
                $y -= 1;
            }

            $houseCoordinates[] = [$x, $y];
        }

        return $houseCoordinates;
    }

    function isEven($number) {
        if ($number % 2 ===0) {
            return true;
        } else {
            return false;
        }
    }

    function readFile()
    {
        $file = fopen('input.txt', 'r');

        if (!$file) {
            echo 'Error opening file.';
            return null;
        }

        return $file;
    }
}