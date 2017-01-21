<?php
namespace PHProfiler\Exporter;

use PHProfiler\Exception\PHProfilerException;
use PHProfiler\Exporter\FileExporter\CsvExporter;
use PHProfiler\Exporter\FileExporter\HtmlExporter;
use PHProfiler\Exporter\FileExporter\JsonExporter;
use PHProfiler\Exporter\FileExporter\LogExporter;
use PHProfiler\Exporter\FileExporter\XmlExporter;

final class ExporterFactory {
    public static function getExporter($type, $data) {
        switch ($type) {
            case ExporterType::LOG:
                return new LogExporter($data);
            case ExporterType::CSV:
                return new CsvExporter($data);
            case ExporterType::XML:
                return new XmlExporter($data);
            case ExporterType::HTML:
                return new HtmlExporter($data);
            case ExporterType::SCREEN:
                return new ScreenExporter($data);
            case ExporterType::JSON:
                return new JsonExporter($data);
            default:
                throw new PHProfilerException(sprintf('Unknown export type: %s', $type));
        }
    }
}
