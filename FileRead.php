<?php

class FileRead
{
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