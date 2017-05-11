<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Point\AbstractPoint;

class LogExporter extends StringFileExporter {
    protected function getDefaultExtension() {
        return 'log';
    }

    protected function exportPoint($point) {
        fprintf($this->filePointer, $this->preparePoint($point));
    }

    protected function preparePoint(AbstractPoint $point) {
        return sprintf("%s\n", $point);
    }
}
