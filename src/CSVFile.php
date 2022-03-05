<?php

namespace App;

use IteratorIterator;
use SplFileObject;

final class CSVFile extends IteratorIterator
{
    private array $csvDocumentHeaders;

    public function __construct(string $pathToFile)
    {
        $splFileObject = new SplFileObject($pathToFile);
        $splFileObject->setFlags(SplFileObject::READ_CSV);
        parent::__construct($splFileObject);
    }

    public function rewind(): void
    {
        parent::rewind();
        $this->csvDocumentHeaders = parent::current();
        parent::next();
    }

    public function current(): object
    {
        return (object) array_combine($this->csvDocumentHeaders, parent::current());
    }

    public function getCsvDocumentHeaders(): array
    {
        return $this->csvDocumentHeaders;
    }
}
