<?php

include __DIR__ . '/autoload.php';

$csvFile = new \app\CSVFile(__DIR__ . '/tests/file1.csv');

foreach ($csvFile as $row) {
    var_dump($row);
}