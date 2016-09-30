<?php
namespace PHProfiler\Exporter;

use PHProfiler\Point\AbstractPoint;

class CsvFileExporter extends FileExporter {
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
