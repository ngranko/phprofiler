<?php
namespace PHProfiler\Exporter;

use PHProfiler\Point\Header;
use PHProfiler\Point\AbstractPoint;

abstract class Exporter {
    protected $printData;

    public function __construct($printData) {
        $this->printData = $printData;
    }

    /**
     * @return AbstractPoint[]
     */
    protected function getPoints() {
        return $this->printData;
    }

    public function getHeaderRow() {
        return new Header();
    }

    abstract public function export();

    abstract protected function preparePoint(AbstractPoint $point);
}
