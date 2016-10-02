<?php
namespace PHProfiler\Exporter;

use PHProfiler\Exception\PHProfilerException;

final class ExporterFactory {
    public static function getExporter($type, $data) {
        switch ($type) {
            case ExporterType::LOG:
                return new LogFileExporter($data);
            case ExporterType::CSV:
                return new CsvFileExporter($data);
            default:
                throw new PHProfilerException(sprintf('Unknown export type: %s', $type));
        }
    }
}
