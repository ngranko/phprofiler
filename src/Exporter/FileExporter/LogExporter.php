<?php
namespace PHProfiler\Exporter\FileExporter;

class LogExporter extends FileExporter {
    protected function getDefaultExtension() {
        return 'log';
    }

    protected function printPoint($filePointer, $point) {
        fprintf($filePointer, $this->preparePoint($point));
    }
}
