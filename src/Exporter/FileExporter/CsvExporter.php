<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Point\AbstractPoint;

class CsvExporter extends StringFileExporter {
    protected function getDefaultExtension(): string {
        return 'csv';
    }

    protected function exportPoint(AbstractPoint $point) {
        fputcsv($this->filePointer, $this->preparePoint($point));
    }

    protected function preparePoint(AbstractPoint $point): array {
        return $point->asArray();
    }
}
