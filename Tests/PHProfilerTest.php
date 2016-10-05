<?php
namespace PHProfilerTests;

use PHProfiler\Exception\PHProfilerException;
use PHProfiler\Exporter\ExporterType;
use PHProfiler\PHProfiler;
use PHProfilerTests\Testers\PHProfilerTester;
use PHPUnit_Framework_TestCase;

class PHProfilerTest extends PHPUnit_Framework_TestCase {
    const INVALID_EXPORT_TYPE = 'test export';

    public function setUp() {
        parent::setUp();
        $this->removeTestFiles();
    }

    private function removeTestFiles() {
        $this->removeCreatedFile($this->getTestLogFileName());
        $this->removeCreatedFile($this->getTestCsvFileName());
    }

    private function removeCreatedFile($path) {
        if (file_exists($path)) {
            unlink($path);
        }
    }

    public function testInitialization() {
        $instance = new PHProfilerTester();
        self::assertTrue($instance instanceof PHProfiler);
        self::assertEquals([], $instance->getRememberedPoints());
    }

    public function testRememberCustomPoint() {
        $profiler = new PHProfilerTester();
        $profiler->rememberPoint('testPoint');
        self::assertCount(1, $profiler->getRememberedPoints());
        self::assertEquals('testPoint', $profiler->getRememberedPoints()[0]->getName());
    }

    public function testRememberDefaultPoint() {
        $profiler = new PHProfilerTester();
        $profiler->rememberPoint();
        self::assertCount(1, $profiler->getRememberedPoints());
        self::assertEquals('point0', $profiler->getRememberedPoints()[0]->getName());
    }

    public function testRememberTwoDefaultPoints() {
        $profiler = new PHProfilerTester();
        $profiler->rememberPoint();
        $profiler->rememberPoint();
        self::assertCount(2, $profiler->getRememberedPoints());
        self::assertEquals('point0', $profiler->getRememberedPoints()[0]->getName());
        self::assertEquals('point1', $profiler->getRememberedPoints()[1]->getName());
    }

    public function testExportToLogFile() {
        self::assertFileNotExists($this->getTestLogFileName());
        $profiler = new PHProfilerTester();
        $profiler->export(ExporterType::LOG, $this->getTestLogFileName());
        self::assertFileExists($this->getTestLogFileName());
    }

    public function testExportToCsvFile() {
        self::assertFileNotExists($this->getTestCsvFileName());
        $profiler = new PHProfilerTester();
        $profiler->export(ExporterType::CSV, $this->getTestCsvFileName());
        self::assertFileExists($this->getTestCsvFileName());
    }

    public function testInvalidExport() {
        try {
            $profiler = new PHProfilerTester();
            $profiler->export(self::INVALID_EXPORT_TYPE, $this->getTestCsvFileName());
        } catch (PHProfilerException $e) {
            self::assertEquals('Unknown export type: test export', $e->getMessage());
        }
    }

    public function tearDown() {
        parent::tearDown();
        $this->removeTestFiles();
    }

    private function getTestLogFileName() {
        return __DIR__ . '/testLogExport.log';
    }

    private function getTestCsvFileName() {
        return __DIR__ . '/testCsvExport.csv';
    }
}
