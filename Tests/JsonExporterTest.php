<?php
namespace PHProfilerTests;

use PHProfiler\Exporter\FileExporter\JsonExporter;

class JsonExporterTest extends AbstractStringFileExporterTest {
    protected $fixedFileName = __DIR__ . '/playground/TestJsonExport.json';
    protected $withHeader = false;

    protected function createExporter() {
        $this->exporter = new JsonExporter($this->getTestPoints());
    }

    protected function getLinesFromFile($filePath) {
        return array_filter(json_decode(file_get_contents($filePath), true));
    }

    protected function toArray($point) {
        return array_values($point);
    }
}
