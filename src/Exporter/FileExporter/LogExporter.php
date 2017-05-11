<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Point\AbstractPoint;

class LogExporter extends StringFileExporter {
    protected function getDefaultExtension(): string {
        return 'log';
    }

    protected function exportPoint(AbstractPoint $point) {
        fprintf($this->filePointer, $this->preparePoint($point));
    }

    protected function preparePoint(AbstractPoint $point): string {
        return sprintf("%s\n", $point);
    }
}
