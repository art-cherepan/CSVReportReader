<?php

require_once __DIR__ . '/vendor/autoload.php';

$csvFile = new \App\CSVFile(__DIR__ . '/Test/Unit/CSVFileWithCorrectData.csv');

foreach ($csvFile as $row) {
    var_dump($row);
}
