<?php
namespace PHProfilerTests;

use PHProfiler\Exporter\FileExporter\JsonExporter;

class JsonExporterTest extends AbstractStringFileExporterTest {
    /** @var string $fixedFileName */
    protected $fixedFileName = 'TestJsonExport.json';
    /** @var bool $withHeader */
    protected $withHeader = false;

    protected function createExporter() {
        $this->exporter = new JsonExporter($this->getTestPoints());
    }

    protected function getLinesFromFile(string $filePath): array {
        return array_filter(json_decode(file_get_contents($filePath), true));
    }

    protected function toArray($point): array {
        return array_values($point);
    }
}
