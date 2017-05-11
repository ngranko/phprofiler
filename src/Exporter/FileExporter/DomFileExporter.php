<?php
namespace PHProfiler\Exporter\FileExporter;

use DOMDocument;
use DOMElement;
use PHProfiler\Point\AbstractPoint;

abstract class DomFileExporter extends FileExporter {
    /** @var DOMDocument $dom */
    protected $dom;
    /** @var DOMElement $dataRoot */
    protected $dataRoot;

    public function __construct($printData) {
        parent::__construct($printData);
        $this->dom = $this->createEmptyDomDocument();
        $this->dom->preserveWhiteSpace = false;
        $this->dom->formatOutput = true;
    }

    abstract protected function createEmptyDomDocument(): DOMDocument;

    public function export() {
        $this->createDocument();
        $this->writeDocument();
    }

    protected function createDocument() {
        $this->dataRoot = $this->prepareWrapper();
        $this->exportPoints();
    }

    abstract protected function prepareWrapper();

    protected function exportPoint(AbstractPoint $point) {
        $this->dataRoot->appendChild($this->preparePoint($point));
    }

    abstract protected function writeDocument();
}
