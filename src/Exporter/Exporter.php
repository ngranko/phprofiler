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
    protected function getPoints(): array {
        return $this->printData;
    }

    abstract public function export();

    protected function exportHeader() {
        $this->exportPoint($this->getHeaderRow());
    }

    public function getHeaderRow(): Header {
        return new Header();
    }

    protected function exportPoints() {
        foreach ($this->getPoints() as $point) {
            $this->exportPoint($point);
        }
    }

    abstract protected function exportPoint(AbstractPoint $point);

    abstract protected function preparePoint(AbstractPoint $point);
}
