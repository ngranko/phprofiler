<?php
namespace PHProfilerTests;

use DOMDocument;
use DOMNodeList;
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

    protected function checkExportedFile(string $filePath) {
        $this->prepareContents($filePath);
        $this->checkWrapper();
        $this->checkExportedPoints();
    }

    protected function prepareContents(string $filePath) {
        self::assertFileExists($filePath);
        $this->loadDomTree($filePath);
        $this->xpath = new DOMXPath($this->dom);
    }

    abstract protected function loadDomTree(string $filePath);

    abstract protected function checkWrapper();

    protected function checkExportedPoints() {
        $expectedPoints = $this->getTestPoints();
        $actualPoints = $this->getExportedPoints();
        self::assertEquals(count($expectedPoints), $actualPoints->length);

        foreach ($actualPoints as $point) {
            $this->checkPoint(array_shift($expectedPoints), $this->toArray($point));
        }
    }

    abstract protected function getExportedPoints(): DOMNodeList;
}
