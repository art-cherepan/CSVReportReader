<?php

require_once __DIR__ . '/vendor/autoload.php';

//$csvFile = new \app\CSVFile(__DIR__ . '/tests/file1.csv');

$csvFile = new \App\CSVFile(__DIR__ . '/tests/file1.csv');

foreach ($csvFile as $row) {
    var_dump($row);
}