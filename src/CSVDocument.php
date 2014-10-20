<?php

class CSVDocument
{
  private $pointer;

  private $delimiter;

  public $data = array();

  private $header = null;

  public function __construct($filePointer, $delimiter = ',')
  {
    if (!is_resource($filePointer)) {
      throw new Exception('Pointer must be a file resource');
    }
    if (!is_string($delimiter)) {
      throw new Exception('Delimiter must be a character');
    }
    $this->pointer = $filePointer;
    $this->delimiter = $delimiter;

    $this->toArray();
  }

  private function toArray()
  {
    $this->header = $this->getRow();
    while (($row = $this->getRow()) !== false) {
      $this->data[] = array_combine($this->header, $row);
    }
  }

  private function getRow()
  {
    return fgetcsv($this->pointer, 1000, $this->delimiter);
  }
}
