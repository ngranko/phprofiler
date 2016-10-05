<?php
namespace PHProfilerTests;

use PHProfilerTests\Testers\LogExporterTester;

class LogFileExporterTest extends AbstractFileExporterTest  {
    protected $fixedFileName = __DIR__ . '/../TestLogExport.log';

    protected function createExporter() {
        $this->exporter = new LogExporterTester($this->getTestPoints());
    }
}
