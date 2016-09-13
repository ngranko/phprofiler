<?php
namespace PHProfiler\Exporter;

class LogFileExporter extends FileExporter {
    protected function getDefaultExtension() {
        return 'log';
    }

    protected function printRow($filePointer, $row) {
        fprintf($filePointer, $this->prepareRow($row));
    }
}
