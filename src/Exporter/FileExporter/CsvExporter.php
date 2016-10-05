<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Point\AbstractPoint;

class CsvExporter extends FileExporter {
    protected function getDefaultExtension() {
        return 'csv';
    }

    protected function preparePoint(AbstractPoint $point) {
        return $point->asArray();
    }

    protected function printPoint($filePointer, $point) {
        fputcsv($filePointer, $this->preparePoint($point));
    }
}
