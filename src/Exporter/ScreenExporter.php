<?php
namespace PHProfiler\Exporter;

use PHProfiler\Point\AbstractPoint;

class ScreenExporter extends Exporter {
    public function export() {
        $this->exportHeader();
        $this->exportPoints();
    }

    protected function exportPoint(AbstractPoint $point) {
        print_r($this->preparePoint($point));
    }

    protected function preparePoint(AbstractPoint $point): string {
        return sprintf('%s<br>', $point);
    }
}
