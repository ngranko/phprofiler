<?php
namespace PHProfilerTests;

use PHProfilerTests\Testers\CsvFileExportTester;

class CsvFileExporterTest extends AbstractFileExporterTest {
    protected $fixedFileName = __DIR__ . '/../TestLogExport.csv';

    protected function createExporter() {
        $this->exporter = new CsvFileExportTester($this->getTestPoints());
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
