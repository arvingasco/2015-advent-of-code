<?php

$dayTwo = new DayTwoAdvent();
$dayTwo->totalWrappingPaper();
echo '<br>';
$dayTwo->totalRibbon();

class DayTwoAdvent extends FileRead
{
    function totalWrappingPaper()
    {
        $adventFile = $this->readFile();

        $totalWrappingPaper = 0;
        while (($line = fgets($adventFile)) !== false) {
            $dimensions = explode('x', $line);

            $presentArea = $this->getSurfaceArea($dimensions[0], $dimensions[1], $dimensions[2]);
            $extraArea = $this->getExtraPaper($dimensions[0], $dimensions[1], $dimensions[2]);
            $totalWrappingPaper += $presentArea + $extraArea;
        }

        fclose($adventFile);

        echo 'The elves need a total of ' . $totalWrappingPaper . ' square feet of wrapping paper.';
    }

    function totalRibbon()
    {
        $adventFile = $this->readFile();

        $totalRibbon = 0;
        while (($line = fgets($adventFile)) !== false) {
            $dimensions = explode('x', $line);

            $ribbonVolume = $this->getVolume($dimensions[0], $dimensions[1], $dimensions[2]);
            $extraRibbon = $this->getSmallestPerimeter($dimensions[0], $dimensions[1], $dimensions[2]);
            $totalRibbon += $ribbonVolume + $extraRibbon;
        }

        fclose($adventFile);

        echo 'The elves need a total of ' . $totalRibbon . ' feet of ribbon.';
    }

    function getSurfaceArea($length, $width, $height)
    {
        return 2*($length*$width + $width*$height + $height*$length);
    }

    function getExtraPaper($length, $width, $height)
    {
        $areaArray = [$length*$width, $width*$height, $height*$length];
        return min($areaArray);
    }

    function getSmallestPerimeter($length, $width, $height)
    {
        $perimeterArray = [$length + $width, $width + $height, $height + $length];
        return 2*min($perimeterArray);
    }

    function getVolume($length, $width, $height)
    {
        return $length*$width*$height;
    }
}