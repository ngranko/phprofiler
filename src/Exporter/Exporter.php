<?php
namespace PHProfiler\Exporter;

use PHProfiler\Point\Header;
use PHProfiler\Point\AbstractPoint;

abstract class Exporter {
    protected $printData;

    public function __construct($printData) {
        $this->printData = $printData;
    }

    abstract public function export();

    public function getHeaderRow() {
        return Header::create();
    }

    protected function preparePoint(AbstractPoint $point) {
        return sprintf(
            "%-28s| %-28s| %-28s| %-28s| %-28s| %-28s\n",
            $point->getName(),
            $point->getTimeCaptured(),
            $point->getTimeElapsed(),
            $point->getMemory(),
            $point->getMemoryHuman(),
            $point->getMemorySinceStart()
        );
    }
}
