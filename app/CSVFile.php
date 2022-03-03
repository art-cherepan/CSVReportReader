<?php

namespace app;

class CSVFile extends DocumentIterator
{
    /**
     * @param string $csvFile
     */
    public function __construct($csvFile)
    {
        parent::__construct(new \SplFileObject($csvFile));
        $this->setFlags(\SplFileObject::READ_CSV);
    }
}