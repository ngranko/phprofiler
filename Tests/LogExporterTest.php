<?php
namespace PHProfilerTests;

use PHProfiler\Exporter\FileExporter\LogExporter;

class LogExporterTest extends AbstractStringFileExporterTest  {
    /** @var string $fixedFileName */
    protected $fixedFileName = '/TestLogExport.log';

    protected function createExporter() {
        $this->exporter = new LogExporter($this->getTestPoints());
    }

    protected function toArray($point): array {
        return explode("|", $point);
    }
}
