<?php
namespace PHProfiler\Exporter;

use PHProfiler\Exception\PHProfilerException;
use PHProfiler\Exporter\FileExporter\CsvExporter;
use PHProfiler\Exporter\FileExporter\LogExporter;

final class ExporterFactory {
    public static function getExporter($type, $data) {
        switch ($type) {
            case ExporterType::LOG:
                return new LogExporter($data);
            case ExporterType::CSV:
                return new CsvExporter($data);
            default:
                throw new PHProfilerException(sprintf('Unknown export type: %s', $type));
        }
    }
}
