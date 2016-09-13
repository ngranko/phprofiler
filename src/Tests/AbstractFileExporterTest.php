<?php
namespace PHProfiler\Tests;

abstract class AbstractFileExporterTest extends AbstractExporterTest {
    protected $fixedFileName;

    public function setUp() {
        parent::setUp();
        $this->removeCreatedFile($this->getFixedFileName());
    }

    public function testExportWithFixedName() {
        $this->doExport($this->getFixedFileName());
        self::assertEquals($this->getFixedFileName(), $this->exporter->getFilePath());
        self::assertFileExists($this->getFixedFileName());
        $this->checkExportedFile($this->getFixedFileName());
    }

    public function testExportWithDefaultName() {
        $this->doExport();
        self::assertFileExists($this->exporter->getFilePath());
        $this->checkExportedFile($this->exporter->getFilePath());
    }

    public function tearDown() {
        parent::tearDown();
        $this->removeCreatedFile($this->exporter->getFilePath());
    }

    protected function doExport($filePath = null) {
        $this->createExporter();
        if (isset($filePath)) {
            $this->exporter->setFilePath($filePath);
        }
        $this->exporter->export();
    }

    abstract protected function createExporter();

    protected function checkExportedFile($filePath) {
        $fileRows = $this->getLinesFromFile($filePath);
        self::assertCount(5, $fileRows);
        $this->checkHead(array_shift($fileRows));
        $this->checkBody($fileRows);
    }

    protected function getLinesFromFile($filePath) {
        return array_filter(explode("\n", file_get_contents($filePath)));
    }

    protected function checkHead($rowToCheck) {
        $headRow = $this->getLineAsArray($rowToCheck);
        $this->checkLine($this->exporter->getHeaderRow(), $headRow);
    }

    protected function checkBody($rowsToCheck) {
        foreach ($rowsToCheck as $index => $row) {
            $rowData = $this->getLineAsArray($row);
            $this->checkLine($this->testPoints[$index], $rowData);
        }
    }

    protected function getLineAsArray($line) {
        return explode("\t\t", $line);
    }

    protected function checkLine($expectedLine, $actualLine) {
        self::assertEquals($expectedLine['name'], $actualLine[0]);
        self::assertEquals($expectedLine['time'], $actualLine[1]);
        self::assertEquals($expectedLine['memory'], $actualLine[2]);
    }

    protected function getFixedFileName() {
        return $this->fixedFileName;
    }

    private function removeCreatedFile($path) {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
