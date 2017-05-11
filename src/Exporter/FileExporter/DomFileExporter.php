<?php
namespace PHProfiler\Exporter\FileExporter;

use DOMDocument;
use DOMElement;

abstract class DomFileExporter extends FileExporter {
    /** @var DOMDocument $dom */
    protected $dom;
    /** @var DOMElement $dataRoot */
    protected $dataRoot;

    public function __construct($printData) {
        parent::__construct($printData);
        $this->createEmptyDomDocument();
        $this->dom->preserveWhiteSpace = false;
        $this->dom->formatOutput = true;
    }

    abstract protected function createEmptyDomDocument();

    public function export() {
        $this->prepareData();
        $this->writeData();
    }

    protected function prepareData() {
        $this->dataRoot = $this->prepareWrapper();
        $this->exportPoints();
    }

    abstract protected function prepareWrapper();

    protected function exportPoint($point) {
        $this->dataRoot->appendChild($this->preparePoint($point));
    }

    abstract protected function writeData();
}
