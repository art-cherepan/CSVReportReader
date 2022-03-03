<?php

include __DIR__ . '/../autoload.php';

$csvEverythingIsFine = new \app\CSVFile(__DIR__ . '/file1.csv');
$csvWithEmptyColumn = new \app\CSVFile(__DIR__ . '/file2.csv');
$csvWithEmptyColumnHeader = new app\CSVFile(__DIR__ . '/file3.csv');

assert(true === testCsvWithDifferentValuesOfHeadingsAndColumns($csvEverythingIsFine));
assert(true === testCsvWithDifferentValuesOfHeadingsAndColumns($csvWithEmptyColumn));
assert(true === testCsvWithDifferentValuesOfHeadingsAndColumns($csvWithEmptyColumnHeader));

function testCsvWithDifferentValuesOfHeadingsAndColumns(\app\CSVFile $csvFile)
{
    foreach ($csvFile as $row) {
        if ('object' !== gettype($row)) {
            return false;
        }
    }

    return true;
}