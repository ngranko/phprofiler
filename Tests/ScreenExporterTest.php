<?php
namespace PHProfilerTests;

use PHProfilerTests\Testers\ScreenExporterTester;

class ScreenExporterTest extends AbstractExporterTest {
    protected function createExporter() {
        $this->exporter = new ScreenExporterTester($this->getTestPoints());
    }

    public function testExport() {
        $this->checkExportResult($this->doExport());
    }

    protected function doExport() {
        $this->createExporter();
        $this->getExporter()->export();
        return $this->getExporter()->getExportResults();
    }

    protected function toArray($point) {
        return explode("|", substr($point, 0, -4));
    }

    private function checkExportResult($exportResult) {
        unset($exportResult[0]);

        $expectedPoints = $this->getTestPoints();
        self::assertEquals(count($expectedPoints), count($exportResult));

        foreach($exportResult as $resultPoint) {
            $this->checkPoint(array_shift($expectedPoints), $this->toArray($resultPoint));
        }
    }
}
