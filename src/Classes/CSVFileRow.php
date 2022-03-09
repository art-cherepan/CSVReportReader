<?php


namespace App;


use Exception;

final class CSVFileRow
{

    private int $id;
    private array $columns;

    public function __construct(int $id, array $columns)
    {
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
