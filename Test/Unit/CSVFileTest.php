<?php

namespace Test\Unit;


use App\CSVFile;
use App\CSVFileRow;
use PHPUnit\Framework\TestCase;

class CSVFileTest extends TestCase
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->createCsvFile(__DIR__ . '/correctData.csv', $this->csvWithCorrectData);
        $this->csvFile = new CSVFile(__DIR__ . '/correctData.csv');

        $this->rows = [];

        foreach ($this->csvFile as $row) {
            $this->rows[] = $row;
        }
    }

    private $csvFile;
    private $rows;

    private $csvWithCorrectData = array(
        array('id', 'column0', 'column1', 'column2'),
        array(1, 'value0', 'value1', 'value2'),
        array(2, 'value3', 'value4', 'value5'),
    );

    private $csvWithFailedId = array(
        array('id', 'column0', 'column1', 'column2'),
        array('foo', 'value0', 'value1', 'value2'),
        array(2, 'value3', 'value4', 'value5'),
    );

    private $csvWithDublicateHeader = array(
        array('id', 'column0', 'column0', 'column2'),
        array(1, 'value0', 'value1', 'value2'),
        array(2, 'value3', 'value4', 'value5'),
    );

    protected function createCsvFile($pathToFile, $csvData): void
    {
        $fp = fopen($pathToFile, 'w+');
        foreach ($csvData as $row) {
            fputcsv($fp, $row);
        }

        fclose($fp);
    }

    public function testCSVFileRowType(): void
    {
        foreach ($this->csvFile as $row) {
            $this->assertInstanceOf(CSVFileRow::class, $row);
        }
    }

    public function testGetIdMethod(): void
    {
        foreach ($this->csvFile as $row) {
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
