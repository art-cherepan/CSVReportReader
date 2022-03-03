<?php

namespace app;

class DocumentIterator extends \IteratorIterator
{
    private $csvDocumentHeaders;

    public function rewind()
    {
        parent::rewind();
        $this->csvDocumentHeaders = parent::current();
        parent::next();
    }

    public function current()
    {
        return (object) array_combine($this->csvDocumentHeaders, parent::current());
    }

    public function getCsvDocumentHeaders()
    {
        return $this->csvDocumentHeaders;
    }
}