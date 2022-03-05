<?php


namespace App;


use Exception;

final class CSVFileRow
{
    private int $id;
    private array $columns;

    public function __construct(int $id, array $columns)
    {
        if (!is_numeric($id)) {
            throw new Exception('Id value must have a numeric format');
        }

        foreach ($columns as $columnHeader => $columnValue) {
            if (empty($columnHeader)) {
                throw new Exception('Document column header must not be empty');
            }
        }

        $this->id = $id;
        $this->columns = $columns;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getColumnNames(): array
    {
        return array_keys($this->columns);
    }

    public function getColumnValue(string $columnName): mixed
    {
        return $this->columns[$columnName];
    }
}
