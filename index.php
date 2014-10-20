<?php

require __DIR__ . '/CSVDocument.php';

$pointer = fopen(__DIR__ . '/tests/data/test.csv', 'r');

$csv = new CSVDocument($pointer);

var_dump($csv->data);

