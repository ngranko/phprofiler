<?php
namespace PHProfilerTests;

use PHProfiler\Exporter\FileExporter\CsvExporter;

class CsvExporterTest extends AbstractStringFileExporterTest {
    /** @var string $fixedFileName */
    protected $fixedFileName = 'TestCsvExport.csv';

    protected function createExporter() {
        $this->exporter = new CsvExporter($this->getTestPoints());
    }

    protected function getLinesFromFile(string $filePath): array {
        $contents = [];
        $pointer = fopen($filePath, 'r');
        while (!feof($pointer)) {
            $contents[] = fgetcsv($pointer);
        }
        return array_filter($contents);
    }

    protected function toArray($point): array {
        return $point;
    }
}
