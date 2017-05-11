<?php
namespace PHProfiler\Exporter\FileExporter;

use DOMDocument;
use DOMElement;
use PHProfiler\Point\AbstractPoint;

class XmlExporter extends DomFileExporter {
    protected function getDefaultExtension(): string {
        return 'xml';
    }

    protected function createEmptyDomDocument(): DOMDocument {
        return new DOMDocument();
    }

    protected function prepareWrapper(): DOMElement {
        $root = $this->dom->appendChild($this->dom->createElement('report'));
        $root->appendChild($this->dom->createElement('points'));
        return $this->dom->getElementsByTagName('points')->item(0);
    }

    protected function preparePoint(AbstractPoint $point): DOMElement {
        $pointNode = $this->dom->createElement('point');
        $pointNode->appendChild($this->dom->createElement('name', htmlentities($point->getName())));
        $pointNode->appendChild($this->dom->createElement('timeCaptured', $point->getTimeCaptured()));
        $pointNode->appendChild($this->dom->createElement('timeSinceStart', $point->getTimeSinceStart()));
        $pointNode->appendChild($this->dom->createElement('memory', $point->getMemory()));
        $pointNode->appendChild($this->dom->createElement('memoryHuman', $point->getMemoryHuman()));
        $pointNode->appendChild($this->dom->createElement('memorySinceStart', $point->getMemorySinceStart()));
        return $pointNode;
    }

    protected function writeDocument() {
        $this->dom->save($this->getFilePath());
    }
}
