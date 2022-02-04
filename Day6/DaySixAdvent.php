<?php
ini_set('memory_limit', '1024M');
set_time_limit(0);

$daySix = new DaySixAdvent();
echo json_encode($daySix->partOne());

class DaySixAdvent
{
    function partOne()
    {
        $lightMap = $this->createLightMap();

        foreach ($this->fileData() as $line) {
            $lineArray = preg_split('/\s+/', $line);

            if ($lineArray[0] === 'toggle') {
                $this->command($lineArray, $lightMap, 'toggle');
            } else if ($lineArray[1] === 'on') {
                array_splice($lineArray, 0, 2, 'turn on');
                $this->command($lineArray, $lightMap, 'turn on');
            } else if ($lineArray[1] === 'off') {
                array_splice($lineArray, 0, 2, 'turn off');
                $this->command($lineArray, $lightMap, 'turn off');
            }
        }

        $count = 0;
        foreach ($lightMap as $coord) {
            if ($coord[2] === 1) {
                $count += 1;
            }
        }

        return $count;
    }

    function createLightMap(): array
    {
        $lightArray = [];

        for ($x = 0; $x <= 999; $x++) {
            for ($y = 0; $y <= 999; $y ++) {
                $lightArray[] = [$x, $y, 0];
            }
        }

        return $lightArray;
    }

    function command($lineArray, $lightMap, $method)
    {
        $lightCoords = $this->extractCoords($lineArray);

        for ($x = $lightCoords[0][0]; $x <= $lightCoords[1][0]; $x++) {
            for ($y = $lightCoords[0][1]; $y <= $lightCoords[1][1]; $y++) {
                $lightKey = array_search([$x, $y, 0], $lightMap);
                if ($lightKey === false) {
                    $lightKey = array_search([$x, $y, 1], $lightMap);
                }

                if ($method === 'toggle') {
                    if ($lightMap[$lightKey][2] === 0) {
                        $lightMap[$lightKey][2] = 1;
                    } else {
                        $lightMap[$lightKey][2] = 0;
                    }
                }

                if ($method === 'turn on' && $lightMap[$lightKey][2] === 0) {
                    $lightMap[$lightKey][2] = 1;
                }

                if ($method === 'turn off' && $lightMap[$lightKey][2] === 1) {
                    $lightMap[$lightKey][2] = 0;
                }
            }
        }
    }

    function extractCoords($lineArray): array
    {
        $firstCoords = explode(',', $lineArray[1]);
        $firstPoint = [intval($firstCoords[0]), intval($firstCoords[1]), 0];

        $secondCoords = explode(',', $lineArray[3]);
        $secondPoint = [intval($secondCoords[0]), intval($secondCoords[1]), 0];

        return [$firstPoint, $secondPoint];
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