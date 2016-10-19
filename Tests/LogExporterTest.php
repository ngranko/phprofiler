<?php
namespace PHProfilerTests;

use PHProfiler\Exporter\FileExporter\LogExporter;

class LogExporterTest extends AbstractStringFileExporterTest  {
    protected $fixedFileName = __DIR__ . '/playground/TestLogExport.log';

    protected function createExporter() {
        $this->exporter = new LogExporter($this->getTestPoints());
    }

    protected function toArray($point) {
        return explode("|", $point);
    }
}
