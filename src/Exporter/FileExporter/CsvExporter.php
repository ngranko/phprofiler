<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Point\AbstractPoint;

class CsvExporter extends StringFileExporter {
    protected function getDefaultExtension() {
        return 'csv';
    }

    protected function exportPoint($point) {
        fputcsv($this->filePointer, $this->preparePoint($point));
    }

    protected function preparePoint(AbstractPoint $point) {
        return $point->asArray();
    }
}
