<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Point\AbstractPoint;

class LogExporter extends StringFileExporter {
    protected function getDefaultExtension() {
        return 'log';
    }

    protected function writePoint($point, $filePointer) {
        fprintf($filePointer, $this->preparePoint($point));
    }

    protected function preparePoint(AbstractPoint $point) {
        return sprintf("%s\n", $point);
    }
}
