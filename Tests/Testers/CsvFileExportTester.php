<?php
namespace PHProfilerTests\Testers;

use PHProfiler\Exporter\CsvFileExporter;

class CsvFileExportTester extends CsvFileExporter {
    public function getFilePath() {
        return $this->filePath;
    }
}
