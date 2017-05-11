<?php

namespace PHProfilerTests\Testers;

use PHProfiler\Exporter\ScreenExporter;

class ScreenExporterTester extends ScreenExporter {
    private $exportResult;

    protected function exportPoint($point) {
        $this->exportResult[] = $this->preparePoint($point);
    }

    public function getExportResults() {
        return $this->exportResult;
    }
}
