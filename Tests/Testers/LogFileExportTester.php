<?php
namespace PHProfilerTests\Testers;

use PHProfiler\Exporter\LogFileExporter;

class LogFileExportTester extends LogFileExporter {
    public function getFilePath() {
        return $this->filePath;
    }
}
