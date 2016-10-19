<?php
namespace PHProfilerTests;

use PHProfiler\Exporter\FileExporter\CsvExporter;

class CsvExporterTest extends AbstractStringFileExporterTest {
    protected $fixedFileName = __DIR__ . '/playground/TestCsvExport.csv';

    protected function createExporter() {
        $this->exporter = new CsvExporter($this->getTestPoints());
    }

    protected function getLinesFromFile($filePath) {
        $contents = [];
        $pointer = fopen($filePath, 'r');
        while (!feof($pointer)) {
            $contents[] = fgetcsv($pointer);
        }
        return array_filter($contents);
    }

    protected function toArray($point) {
        return $point;
    }
}
