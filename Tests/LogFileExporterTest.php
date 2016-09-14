<?php
namespace PHProfilerTests;

use PHProfilerTests\Testers\LogFileExportTester;

class LogFileExporterTest extends AbstractFileExporterTest  {
    protected $fixedFileName = __DIR__ . '/../TestLogExport.log';

    protected function createExporter() {
        $this->exporter = new LogFileExportTester($this->getTestPoints());
    }
}
