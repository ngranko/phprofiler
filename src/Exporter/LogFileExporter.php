<?php
namespace PHProfiler\Exporter;

class LogFileExporter extends FileExporter {
    protected function getDefaultExtension() {
        return 'log';
    }

    protected function printPoint($filePointer, $point) {
        fprintf($filePointer, $this->preparePoint($point));
    }
}
