<?php
namespace PHProfilerTests;

use DOMElement;
use DOMNodeList;
use PHProfiler\Exporter\FileExporter\XmlExporter;

class XmlExporterTest extends AbstractDomFileExporterTest {
    /** @var string $fixedFileName */
    protected $fixedFileName = 'TestXmlExport.xml';

    protected function createExporter() {
        $this->exporter = new XmlExporter($this->getTestPoints());
    }

    protected function loadDomTree(string $filePath) {
        $this->dom->load($filePath);
    }

    protected function checkWrapper() {
        self::assertEquals(1, $this->xpath->query('/report/points')->length);
    }

    protected function getExportedPoints(): DOMNodeList {
        return $this->xpath->query('/report/points/point');
    }

    protected function toArray($point): array {
        /** @var DOMElement $point */
        return [
            $point->getElementsByTagName('name')->item(0)->nodeValue,
            $point->getElementsByTagName('timeCaptured')->item(0)->nodeValue,
            $point->getElementsByTagName('timeSinceStart')->item(0)->nodeValue,
            $point->getElementsByTagName('memory')->item(0)->nodeValue,
            $point->getElementsByTagName('memoryHuman')->item(0)->nodeValue,
            $point->getElementsByTagName('memorySinceStart')->item(0)->nodeValue,
        ];
    }
}
