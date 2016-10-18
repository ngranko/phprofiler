<?php
namespace PHProfilerTests;

use DOMDocument;
use DOMXPath;

abstract class AbstractDomFileExporterTest extends AbstractFileExporterTest {
    /** @var DOMDocument $dom */
    protected $dom;

    /** @var DOMXPath $xpath */
    protected $xpath;

    public function setUp() {
        parent::setUp();
        $this->dom = new DOMDocument();
    }

    protected function checkExportedFile($filePath) {
        $this->loadContents($filePath);
        $this->checkWrapper();
        $this->checkExportedPoints();
    }

    protected function loadContents($filePath) {
        $this->dom->load($filePath);
        $this->xpath = new DOMXPath($this->dom);
    }

    abstract protected function checkWrapper();

    protected function checkExportedPoints() {
        $expectedPoints = $this->getTestPoints();
        $actualPoints = $this->getExportedPoints();
        self::assertEquals(count($expectedPoints), $actualPoints->length);

        foreach ($actualPoints as $point) {
            $pointArray = $this->toArray($point);
            $this->checkPoint(array_shift($expectedPoints), $pointArray);
        }
    }

    abstract protected function getExportedPoints();
}
