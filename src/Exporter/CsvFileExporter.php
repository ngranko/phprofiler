<?php
namespace PHProfiler\Exporter;

class CsvFileExporter extends FileExporter {
    protected function getDefaultExtension() {
        return 'csv';
    }

    protected function prepareBodyRow($row) {
        return array_values($row);
    }

    protected function prepareHeaderRow($row) {
        unset($row['isHeader']);
        return $row;
    }

    protected function printRow($filePointer, $row) {
        fputcsv($filePointer, $this->prepareRow($row));
    }
}
