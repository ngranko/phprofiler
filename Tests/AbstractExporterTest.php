<?php
namespace PHProfilerTests;

use PHProfiler\Exporter\FileExporter\FileExporter;
use PHProfiler\Point\AbstractPoint;
use PHProfiler\Point\Point;
use PHPUnit\Framework\TestCase;

abstract class AbstractExporterTest extends TestCase {
    /** @var FileExporter */
    protected $exporter;
    private $testPoints = [];

    const START_TIME = 1473262478.911812;
    const START_MEMORY = 3920000;

    public function setUp() {
        parent::setUp();

        $this->testPoints[] = new Point('test point 1', self::START_TIME, self::START_MEMORY);
        $this->testPoints[] = new Point('test point 2', self::START_TIME, self::START_MEMORY);
        $this->testPoints[] = new Point('test point 3', self::START_TIME, self::START_MEMORY);
        $this->testPoints[] = new Point('test point 4', self::START_TIME, self::START_MEMORY);
        $this->testPoints[] = new Point('<test point 5>', self::START_TIME, self::START_MEMORY);
        $this->testPoints[] = new Point('test point & 6', self::START_TIME, self::START_MEMORY);
    }

    abstract protected function doExport();

    abstract protected function createExporter();

    protected function getExporter() {
        return $this->exporter;
    }

    protected function getTestPoints() {
        return $this->testPoints;
    }

    abstract protected function toArray($point);

    protected function checkPoint(AbstractPoint $expectedPoint, $actualPoint) {
        self::assertEquals($expectedPoint->getName(), trim($actualPoint[0]));
        self::assertEquals($expectedPoint->getTimeCaptured(), trim($actualPoint[1]));
        self::assertEquals($expectedPoint->getTimeSinceStart(), trim($actualPoint[2]));
        self::assertEquals($expectedPoint->getMemory(), trim($actualPoint[3]));
        self::assertEquals($expectedPoint->getMemoryHuman(), trim($actualPoint[4]));
        self::assertEquals($expectedPoint->getMemorySinceStart(), trim($actualPoint[5]));
    }
}
