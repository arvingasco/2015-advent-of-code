<?php

$daySeven = new DaySevenAdvent();
echo json_encode($daySeven->partOne());

class DaySevenAdvent
{
    function partOne()
    {
        $allWires = [];
        $wireValues = [];

        foreach ($this->fileData() as $line) {
            preg_match_all('/[a-z]+/', $line, $wires);
            $wires = $wires[0];
            foreach ($wires as $wire) {
                $allWires[] = $wire;

            }
        }

        $allWires = array_values(array_unique($allWires));

        foreach ($allWires as $ignored) {
            $wireValues[] = 0;
        }

        $keyValueA = array_search('x', $allWires);

        foreach ($this->fileData() as $line) {
            preg_match_all('/[a-z]+/', $line, $wires);
            $wires = $wires[0];

            if (preg_match('/[A-Z]+/', $line, $method)) {
                $method = $method[0];
            } else {
                $method = 'TO';
            }

            preg_match('/[0-9]+/', $line, $number);
            if (empty($number) === false) {
                $number = intval($number[0]);
            }

            $key1 = array_search($wires[0], $allWires);
            if ($method === 'AND') {
                $key2 = array_search($wires[1], $allWires);
                if (count($wires) === 3) {
                    $key3 = array_search($wires[2], $allWires);
                    $wireValues[$key3] = $wireValues[$key1] & $wireValues[$key2];
                } else {
                    $wireValues[$key2] = $number & $wireValues[$key1];
                }

            } else if ($method === 'OR') {
                $key2 = array_search($wires[1], $allWires);
                $key3 = array_search($wires[2], $allWires);
                $wireValues[$key3] = $wireValues[$key1] | $wireValues[$key2];

            } else if ($method === 'NOT') {
                $key2 = array_search($wires[1], $allWires);
                $wireValues[$key2] = ~ $wireValues[$key1];
                $wireValues[$key2] = (($wireValues[$key2] % 65536) + 65536) % 65536;

            } else if ($method === 'LSHIFT') {
                $key2 = array_search($wires[1], $allWires);
                $wireValues[$key2] = $wireValues[$key1] << $number;

            } else if ($method === 'RSHIFT') {
                $key2 = array_search($wires[1], $allWires);
                $wireValues[$key2] = $wireValues[$key1] >> $number;

            } else {
                if (count($wires) === 2) {
                    $key2 = array_search($wires[1], $allWires);
                    $wireValues[$key2] += $wireValues[$key1];
                } else {
                    $wireValues[$key1] += $number;
                }
            }
        }

        return $wireValues[$keyValueA];
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

