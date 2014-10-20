<?php

namespace someoddpilot\csvdocument;

use Exception;

class CSVDocument
{
  /**
   * @type resource
   */
  private $pointer;

  /**
   * @type string
   */
  private $delimiter;

  /**
   * @type array
   */
  public $data = array();

  /**
   * @type array
   */
  private $header = null;

  /**
   * @param $filePointer resource
   * @param $delimiter   string
   */
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

  /**
   * @return void
   */
  private function toArray()
  {
    $this->header = $this->getRow();
    while (($row = $this->getRow()) !== false) {
      $this->data[] = array_combine($this->header, $row);
    }
  }

  /**
   * @return array
   */
  private function getRow()
  {
    return fgetcsv($this->pointer, 1000, $this->delimiter);
  }
}
