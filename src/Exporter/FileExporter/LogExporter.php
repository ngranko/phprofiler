<?php
namespace PHProfiler\Exporter\FileExporter;

class LogExporter extends StringFileExporter {
    protected function getDefaultExtension() {
        return 'log';
    }

    protected function writePoint($point, $filePointer) {
        fprintf($filePointer, $this->preparePoint($point));
    }
}
