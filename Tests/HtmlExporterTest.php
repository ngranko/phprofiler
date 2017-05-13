<?php
namespace PHProfilerTests;

use DOMNodeList;
use PHProfiler\Exporter\FileExporter\HtmlExporter;

class HtmlExporterTest extends AbstractDomFileExporterTest {
    /** @var string $fixedFileName */
    protected $fixedFileName = 'TestHtmlExport.html';

    protected function createExporter() {
        $this->exporter = new HtmlExporter($this->getTestPoints());
    }

    protected function checkExportedFile(string $filePath) {
        self::assertFileExists(dirname($filePath) . HtmlExporter::STYLESHEET_RELATIVE_PATH);
        parent::checkExportedFile($filePath);
    }

    protected function loadDomTree(string $filePath) {
        $this->dom->loadHTMLFile($filePath);
    }

    protected function checkWrapper() {
        self::assertEquals('PHProfiler Report', $this->xpath->query('/html/head/title')->item(0)->nodeValue);
        $this->checkTableHeader();
        self::assertEquals(1, $this->xpath->query('/html/body/table/tbody')->length);
    }

    private function checkTableHeader() {
        $headerValues = $this->xpath->query('/html/body/table/thead/tr/th');
        self::assertEquals('Point Name', $headerValues->item(0)->nodeValue);
        self::assertEquals('Point captured on', $headerValues->item(1)->nodeValue);
        self::assertEquals('Time from start (sec)', $headerValues->item(2)->nodeValue);
        self::assertEquals('Memory used (b)', $headerValues->item(3)->nodeValue);
        self::assertEquals('Memory used', $headerValues->item(4)->nodeValue);
        self::assertEquals('Memory compared to start (b)', $headerValues->item(5)->nodeValue);
    }

    protected function getExportedPoints(): DOMNodeList {
        return $this->xpath->query('/html/body/table/tbody/tr');
    }

    protected function toArray($point): array {
        /** @var \DOMElement $point */
        $dataNodes = $point->getElementsByTagName('td');
        return [
            $dataNodes->item(0)->nodeValue,
            $dataNodes->item(1)->nodeValue,
            $dataNodes->item(2)->nodeValue,
            $dataNodes->item(3)->nodeValue,
            $dataNodes->item(4)->nodeValue,
            $dataNodes->item(5)->nodeValue,
        ];
    }
}
