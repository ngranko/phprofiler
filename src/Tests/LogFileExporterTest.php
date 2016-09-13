<?php
namespace PHProfiler\Tests;

use PHProfiler\Exporter\LogFileExporter;

class LogFileExporterTest extends AbstractFileExporterTest  {
    protected $fixedFileName = __DIR__ . '/../TestLogExport.log';

    protected function createExporter() {
        $this->exporter = new LogFileExporter($this->testPoints);
    }
}
