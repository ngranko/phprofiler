<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Point\AbstractPoint;

class JsonExporter extends StringFileExporter {
    protected function getDefaultExtension() {
        return 'json';
    }

    protected function exportPoints() {
        fprintf($this->filePointer, $this->preparePoints());
    }

    private function preparePoints() {
        $points = [];
        foreach ($this->getPoints() as $point) {
            $points[] = $this->exportPoint($point);
        }
        return json_encode($points);
    }

    protected function preparePoint(AbstractPoint $point) {
        return $point->asArray();
    }

    protected function exportPoint($point) {
        return $this->preparePoint($point);
    }
}
