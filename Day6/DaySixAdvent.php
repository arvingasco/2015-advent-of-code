<?php
ini_set('memory_limit', '1024M');
set_time_limit(0);

$daySix = new DaySixAdvent();

echo json_encode($daySix->partOne());
echo '<br>';
echo json_encode($daySix->partTwo());

class DaySixAdvent
{
    function partOne()
    {
        $lightMap = $this->createLightMap();

        foreach ($this->fileData() as $line) {
            $lineArray = preg_split('/\s+/', $line);

            if ($lineArray[0] === 'toggle') {
                $lightMap = $this->commandOne($lineArray, $lightMap, 'toggle');
            } else if ($lineArray[1] === 'on') {
                array_splice($lineArray, 0, 2, 'turn on');
                $lightMap = $this->commandOne($lineArray, $lightMap, 'turn on');
            } else if ($lineArray[1] === 'off') {
                array_splice($lineArray, 0, 2, 'turn off');
                $lightMap = $this->commandOne($lineArray, $lightMap, 'turn off');
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

    function partTwo()
    {
        $lightMap = $this->createLightMap();

        foreach ($this->fileData() as $line) {
            $lineArray = preg_split('/\s+/', $line);

            if ($lineArray[0] === 'toggle') {
                $lightMap = $this->commandTwo($lineArray, $lightMap, 'toggle');
            } else if ($lineArray[1] === 'on') {
                array_splice($lineArray, 0, 2, 'turn on');
                $lightMap = $this->commandTwo($lineArray, $lightMap, 'turn on');
            } else if ($lineArray[1] === 'off') {
                array_splice($lineArray, 0, 2, 'turn off');
                $lightMap = $this->commandTwo($lineArray, $lightMap, 'turn off');
            }
        }

        $brightness = 0;
        foreach ($lightMap as $coord) {
            $brightness += $coord[2];
        }

        return $brightness;
    }

    function commandTwo($lineArray, $lightMap, $method)
    {
        $lightCoords = $this->extractCoords($lineArray);

        for ($x = $lightCoords[0][0]; $x <= $lightCoords[1][0]; $x++) {
            for ($y = $lightCoords[0][1]; $y <= $lightCoords[1][1]; $y++) {
                $lightKey = array_search([$x, $y, 0], $lightMap);
                if ($lightKey === false) {
                    $lightKey = array_search([$x, $y, 1], $lightMap);
                }

                if ($method === 'toggle') {
                    $lightMap[$lightKey][2] += 2;
                }

                if ($method === 'turn on' ) {
                    $lightMap[$lightKey][2] += 1;
                }

                if ($method === 'turn off' && $lightMap[$lightKey][2] !== 0) {
                    $lightMap[$lightKey][2] -= 1;
                }
            }
        }
        return $lightMap;
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

    function commandOne($lineArray, $lightMap, $method)
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

                if ($method === 'turn on') {
                    $lightMap[$lightKey][2] = 1;
                }

                if ($method === 'turn off') {
                    $lightMap[$lightKey][2] = 0;
                }
            }
        }
        return $lightMap;
    }

    function extractCoords($lineArray)
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