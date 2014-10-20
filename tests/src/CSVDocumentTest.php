<?php

class CSVDocumentTest extends PHPUnit_Framework_TestCase
{
  public function testBasics()
  {
    $pointer = fopen(dirname(__DIR__) . '/data/test.csv', 'r');

    $csv = new CSVDocument($pointer);

    $this->assertInternalType('array', $csv->data);
  }

  public function testPointerErrors()
  {
    $this->setExpectedException('Exception', 'Pointer must be a file resource');

    new CSVDocument(null);
  }

  public function testDelimiterErrors()
  {
    $pointer = fopen(dirname(__DIR__) . '/data/test.csv', 'r');

    $this->setExpectedException('Exception', 'Delimiter must be a character');

    new CSVDocument($pointer, null);
  }
}
