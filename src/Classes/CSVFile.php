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
        $csvContentWithoutEmptyRows = '';

        try {
            $content = file_get_contents($pathToFile);
            $rows = explode(PHP_EOL, $content);
            foreach ($rows as $row) {
                if ($row != '') {
                    $csvContentWithoutEmptyRows .= $row . PHP_EOL;
                }
            }

            $csvContentWithoutEmptyRows = mb_substr($csvContentWithoutEmptyRows, 0, -1);

            file_put_contents($pathToFile, $csvContentWithoutEmptyRows);

        } catch (Exception $e) {
            echo 'Throw exception: ', $e->getMessage(), PHP_EOL;
        }

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

        $this->columnHeaders = parent::current();

        parent::next();
    }

    public function current(): object
    {
        return new CSVFileRow(parent::current()[0], array_combine($this->columnHeaders, parent::current()));
    }
}
