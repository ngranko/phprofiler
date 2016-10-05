<?php
namespace PHProfilerTests\Testers;

use PHProfiler\Exporter\FileExporter\CsvExporter;

class CsvExporterTester extends CsvExporter {
    public function getFilePath() {
        return $this->filePath;
    }
}
