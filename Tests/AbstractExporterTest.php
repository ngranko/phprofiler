<?php
namespace PHProfilerTests;

use PHProfiler\Exporter\FileExporter;
use PHProfiler\Point\Point;
use PHPUnit_Framework_TestCase;

abstract class AbstractExporterTest extends PHPUnit_Framework_TestCase {
    /** @var FileExporter */
    protected $exporter;
    private $testPoints = [];

    const START_TIME = 1473262478.911812;
    const START_MEMORY = 3920000;

    public function setUp() {
        parent::setUp();

        $this->testPoints[] = Point::create('test point 1', self::START_TIME, self::START_MEMORY);
        $this->testPoints[] = Point::create('test point 2', self::START_TIME, self::START_MEMORY);
        $this->testPoints[] = Point::create('test point 3', self::START_TIME, self::START_MEMORY);
        $this->testPoints[] = Point::create('test point 4', self::START_TIME, self::START_MEMORY);
    }

    abstract protected function doExport();

    protected function getExporter() {
        return $this->exporter;
    }

    protected function getTestPoints() {
        return $this->testPoints;
    }
}
