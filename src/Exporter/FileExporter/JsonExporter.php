<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Point\AbstractPoint;

class JsonExporter extends StringFileExporter {
    protected function getDefaultExtension() {
        return 'json';
    }

    protected function writeHeader($filePointer) {
        // no headers on that export type
    }

    protected function writePoints($filePointer) {
        fprintf($filePointer, $this->preparePoints());
    }

    private function preparePoints() {
        $points = [];
        foreach ($this->getPoints() as $point) {
            $points[] = $this->preparePoint($point);
        }
        return json_encode($points);
    }

    protected function preparePoint(AbstractPoint $point) {
        return $point->asArray();
    }

    protected function writePoint($point, $filePointer) {
        // we are writing all points at once, no need for this function
    }
}
