<?php

namespace app;

class CSVFile extends DocumentIterator
{
    /**
     * @param string $pathToFile
     */
    public function __construct($pathToFile)
    {
        parent::__construct(new \SplFileObject($pathToFile));
        $this->setFlags(\SplFileObject::READ_CSV);
    }
}