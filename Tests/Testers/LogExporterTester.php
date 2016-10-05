<?php
namespace PHProfilerTests\Testers;

use PHProfiler\Exporter\FileExporter\LogExporter;

class LogExporterTester extends LogExporter {
    public function getFilePath() {
        return $this->filePath;
    }
}
