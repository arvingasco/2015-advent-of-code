<?php

$dayOne = new DayOneAdvent();
$dayOne->findSantasFloor();
echo '<br>';
$dayOne->leadSantaToBasement();

class DayOneAdvent {
    function findSantasFloor()
    {
        $adventFile = $this->readFile();
        $puzzleInput = fgets($adventFile);
        fclose($adventFile);

        $floorsUp = substr_count($puzzleInput, '(');
        $floorsDown = substr_count($puzzleInput, ')');
        $floorPosition = $floorsUp - $floorsDown;

        echo 'Santa is at floor ' . $floorPosition;
    }

    function leadSantaToBasement()
    {
        $adventFile = $this->readFile();
        $puzzleInput = fgets($adventFile);
        fclose($adventFile);

        $characters = str_split($puzzleInput);
        $characterPosition = 0;
        $floor = 0;
        foreach ($characters as $character) {
            if ($character === '(') {
                $floor += 1;
            } else {
                $floor -= 1;
            }
            $characterPosition += 1;

            if ($floor === -1) {
                echo 'Santa is led to the basement at character position ' . $characterPosition;
                break;
            }
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