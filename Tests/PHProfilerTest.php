<?php
namespace PHProfilerTests;

use PHProfiler\Exporter\ExporterType;
use PHProfiler\PHProfiler;
use PHProfilerTests\Testers\PHProfilerTester;
use PHPUnit\Framework\TestCase;

class PHProfilerTest extends TestCase {
    const TEST_FILE_NAME = __DIR__ . '/playground/testExport';

    use FileSystemHandler;

    public function setUp() {
        parent::setUp();
        $this->createTestFolderIfNotExists();
        $this->deleteTestFile();
    }

    private function deleteTestFile() {
        if (file_exists(self::TEST_FILE_NAME)) {
            unlink(self::TEST_FILE_NAME);
        }
    }

    public function tearDown() {
        parent::tearDown();
        $this->deleteTestFile();
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
        self::assertFileNotExists(self::TEST_FILE_NAME);
        $profiler = new PHProfilerTester();
        $profiler->export(ExporterType::LOG, self::TEST_FILE_NAME);
        self::assertFileExists(self::TEST_FILE_NAME);
    }
}
