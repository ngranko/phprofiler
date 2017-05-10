<?php
namespace PHProfiler\Exporter;

use PHProfiler\Point\AbstractPoint;

class ScreenExporter extends Exporter {
    public function export() {
        $this->printHeader();
        $this->printPoints();
    }

    private function printHeader() {
        $this->printPoint($this->getHeaderRow());
    }

    private function printPoints() {
        foreach ($this->getPoints() as $point) {
            $this->printPoint($point);
        }
    }

    protected function printPoint($point) {
        print_r($this->preparePoint($point));
    }

    protected function preparePoint(AbstractPoint $point) {
        return sprintf('%s<br>', $point);
    }
}
