<?php


namespace App;


use IteratorIterator;
use SplFileObject;
use Exception;

final class CSVFile extends IteratorIterator
{

    private $columnHeaders;

    public function __construct(string $pathToFile)
    {
        $splFileObject = new SplFileObject($pathToFile);
        $splFileObject->setFlags(SplFileObject::READ_CSV);
        parent::__construct($splFileObject);
    }

    public function rewind(): void
    {
        parent::rewind();

        $columnsUnique = array_unique(parent::current());

        if ($columnsUnique != parent::current()) {
            throw new Exception('Column headers must be unique');
        }

        foreach (parent::current() as $columnHeader) {
            if (empty($columnHeader)) {
                throw new Exception('Document column header must not be empty');
            }
        }

        $this->columnHeaders = parent::current();

        parent::next();
    }

    public function current(): object
    {
        return new CSVFileRow(parent::current()[0], array_combine($this->columnHeaders, parent::current()));
    }

}
