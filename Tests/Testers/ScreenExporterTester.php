<?php

namespace PHProfilerTests\Testers;

use PHProfiler\Exporter\ScreenExporter;
use PHProfiler\Point\AbstractPoint;

class ScreenExporterTester extends ScreenExporter {
    /** @var array $exportResult */
    private $exportResult;

    protected function exportPoint(AbstractPoint $point) {
        $this->exportResult[] = $this->preparePoint($point);
    }

    public function getExportResults(): array {
        return $this->exportResult;
    }
}
