<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Point\AbstractPoint;

class JsonExporter extends StringFileExporter {
    protected function getDefaultExtension(): string {
        return 'json';
    }

    protected function exportPoints() {
        fprintf($this->filePointer, $this->preparePoints());
    }

    private function preparePoints(): string {
        $points = [];
        foreach ($this->getPoints() as $point) {
            $points[] = $this->preparePoint($point);
        }
        return json_encode($points);
    }

    protected function preparePoint(AbstractPoint $point): array {
        return $point->asArray();
    }

    protected function exportPoint(AbstractPoint $point): array {
        return $this->preparePoint($point);
    }
}
