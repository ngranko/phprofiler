<?php
namespace PHProfilerTests;

use PHProfiler\Exception\PHProfilerException;
use PHProfiler\Exporter\ExporterFactory;
use PHProfiler\Exporter\ExporterType;
use PHPUnit\Framework\TestCase;

class ExporterFactoryTest extends TestCase {
    const INVALID_EXPORT_TYPE = 'test export';

    /**
     * @dataProvider getExporterDataProvider()
     * @param $type
     * @param $className
     */
    public function testGetExporter($type, $className) {
        $exporter = ExporterFactory::getExporter($type, []);

        self::assertInstanceOf($className, $exporter);
    }

    public function getExporterDataProvider() {
        return [
            [ExporterType::LOG, 'PHProfiler\Exporter\FileExporter\LogExporter'],
            [ExporterType::CSV, 'PHProfiler\Exporter\FileExporter\CsvExporter'],
            [ExporterType::XML, 'PHProfiler\Exporter\FileExporter\XmlExporter'],
            [ExporterType::HTML, 'PHProfiler\Exporter\FileExporter\HtmlExporter'],
            [ExporterType::SCREEN, 'PHProfiler\Exporter\ScreenExporter'],
            [ExporterType::JSON, 'PHProfiler\Exporter\FileExporter\JsonExporter'],
        ];
    }

    public function testGetInvalidExporter() {
        try {
            ExporterFactory::getExporter(self::INVALID_EXPORT_TYPE, []);
            self::fail('This test should throw an exception');
        } catch (PHProfilerException $e) {
            self::assertEquals(sprintf('Unknown export type: %s', self::INVALID_EXPORT_TYPE), $e->getMessage());
        }
    }
}
