<?php
namespace PHProfilerTests;

use PHProfiler\Exporter\FileExporter;
use PHPUnit_Framework_TestCase;

abstract class AbstractExporterTest extends PHPUnit_Framework_TestCase {
    /** @var FileExporter */
    protected $exporter;
    private $testPoints = [
        [
            'name' => 'test point 1',
            'time' => 0.000001,
            'memory' => 52345,
        ],
        [
            'name' => 'test point 2',
            'time' => 0.000011,
            'memory' => 75834,
        ],
        [
            'name' => 'test point 3',
            'time' => 0.000018,
            'memory' => 142037,
        ],
        [
            'name' => 'test point 4',
            'time' => 0.000375,
            'memory' => 643782,
        ],
    ];

    abstract protected function doExport();

    protected function getExporter() {
        return $this->exporter;
    }

    protected function getTestPoints() {
        return $this->testPoints;
    }
}
