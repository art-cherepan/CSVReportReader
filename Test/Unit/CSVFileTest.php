<?php

namespace Test\Unit;


use App\CSVFile;
use App\CSVFileRow;
use PHPUnit\Framework\TestCase;

class CSVFileTest extends TestCase
{

    private CSVFile $csvFileWithCorrectData;

    private array $rows;

    private $csvWithCorrectData = array(
        'id,column0,column1,column2',
        '1,value0,value1,value2',
        '2,value3,value4,value5',
        '3,value6,value7,value8'
    );

    public function setUp(): void
    {
        $this->createCsvFile(__DIR__ . '/CSVFileWithCorrectData.csv', $this->csvWithCorrectData);

        $this->csvFileWithCorrectData = new CSVFile(__DIR__ . '/CSVFileWithCorrectData.csv');

        $this->rows = [];

        foreach ($this->csvFileWithCorrectData as $row) {
            $this->rows[] = $row;
        }
    }

    private function createCsvFile(string $pathToFile, array $csvData): void
    {
        $fp = fopen($pathToFile, 'w+');

        for ($i = 0; $i < count($csvData) - 1; $i++) {
            fputs($fp, $csvData[$i] . PHP_EOL);
        }

        fputs($fp, $csvData[$i]);

        fclose($fp);
    }

    public function testCSVFileRowType(): void
    {
        foreach ($this->csvFileWithCorrectData as $row) {
            $this->assertInstanceOf(CSVFileRow::class, $row);
        }
    }

    public function testGetIdMethod(): void
    {
        foreach ($this->csvFileWithCorrectData as $row) {
            $this->assertNotEmpty($row->getId());
        }
    }

    public function testColumnValue(): void
    {
        $this->assertEquals('value0', $this->rows[0]->getColumns()['column0']);
        $this->assertEquals('value1', $this->rows[0]->getColumns()['column1']);
        $this->assertEquals('value2', $this->rows[0]->getColumns()['column2']);
    }

    public function testColumnNames(): void
    {
        $this->assertEquals(['id', 'column0', 'column1', 'column2'], $this->rows[0]->getColumnNames());
        $this->assertEquals(['id', 'column0', 'column1', 'column2'], $this->rows[1]->getColumnNames());
    }

}
