<?php
namespace PHProfilerTests;

use org\bovigo\vfs\vfsStream;
use PHProfiler\Exporter\ExporterType;
use PHProfiler\PHProfiler;
use PHProfilerTests\Testers\PHProfilerTester;
use PHPUnit\Framework\TestCase;

class PHProfilerTest extends TestCase {
    const TEST_FILE_NAME = 'testExport';

    public function setUp() {
        parent::setUp();
        vfsStream::setup('playground');
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

    public function testExport() {
        $testFilename = $this->getTestFilepath();
        self::assertFileNotExists($testFilename);
        $profiler = new PHProfilerTester();
        $profiler->export(ExporterType::LOG, $testFilename);
        self::assertFileExists($testFilename);
    }

    private function getTestFilepath() {
        return vfsStream::url('playground') . DIRECTORY_SEPARATOR . self::TEST_FILE_NAME;
    }
}
