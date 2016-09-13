<?php
namespace PHProfiler\Tests;

use PHProfiler\Exporter\CsvFileExporter;

class CsvFileExporterTest extends AbstractFileExporterTest {
    protected $fixedFileName = __DIR__ . '/../TestLogExport.csv';

    protected function createExporter() {
        $this->exporter = new CsvFileExporter($this->testPoints);
    }

    protected function getLinesFromFile($filePath) {
        $contents = [];
        $pointer = fopen($filePath, 'r');
        while (!feof($pointer)) {
            $contents[] = fgetcsv($pointer);
        }
        return array_filter($contents);
    }

    protected function getLineAsArray($line) {
        return $line;
    }
}
