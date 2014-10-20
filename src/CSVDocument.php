<?php

namespace someoddpilot\csvdocument;

use Exception;

class CSVDocument
{
  /**
   * File pointer to CSV document
   *
   * @type resource
   */
  private $pointer;

  /**
   * String delimiter for CSV document
   * Should typically be ','
   *
   * @type string
   */
  private $delimiter;

  /**
   * Array of real data
   *
   * @type array
   */
  public $data = array();

  /**
   * Header data
   *
   * @type array
   */
  private $header = null;

  /**
   * Constructor which takes in a file pointer and a delimiter string
   * Processes file data to return associative array with headers as keys
   *
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
   * Processes data row by row
   *
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
   * Gets single row from file pointer
   *
   * @return array
   */
  private function getRow()
  {
    return fgetcsv($this->pointer, 1000, $this->delimiter);
  }
}
