<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Point\AbstractPoint;

class CsvExporter extends StringFileExporter {
    protected function getDefaultExtension() {
        return 'csv';
    }

    protected function preparePoint(AbstractPoint $point) {
        return $point->asArray();
    }

    protected function writePoint($point, $filePointer) {
        fputcsv($filePointer, $this->preparePoint($point));
    }
}