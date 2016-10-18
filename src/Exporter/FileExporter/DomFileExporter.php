<?php
namespace PHProfiler\Exporter\FileExporter;

use DOMDocument;
use DOMElement;

abstract class DomFileExporter extends FileExporter {
    /** @var DOMDocument $dom */
    protected $dom;

    public function __construct($printData) {
        parent::__construct($printData);
        $this->dom = new DOMDocument();
        $this->dom->preserveWhiteSpace = false;
        $this->dom->formatOutput = true;
    }

    public function export() {
        $this->prepareData();
        $this->writeData();
    }

    protected function prepareData() {
        $this->prepareWrapper();
        $this->preparePointsData();
    }

    abstract protected function prepareWrapper();

    protected function preparePointsData() {
        $parentElement = $this->getRootDataElement();
        foreach ($this->getPrintData() as $point) {
            $pointNode = $this->preparePoint($point);
            $this->addPointToDom($parentElement, $pointNode);
        }
    }

    abstract protected function getRootDataElement();

    protected function addPointToDom(DOMElement $parentElement, DOMElement $pointNode) {
        $parentElement->appendChild($pointNode);
    }

    protected function writeData() {
        $this->dom->save($this->getFilePath());
    }
}
