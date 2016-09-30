<?php
namespace PHProfilerTests;

use PHProfiler\Point\AbstractPoint;

abstract class AbstractFileExporterTest extends AbstractExporterTest {
    protected $fixedFileName;

    public function setUp() {
        parent::setUp();
        $this->removeCreatedFile($this->getFixedFileName());
    }

    public function testExportWithFixedName() {
        $this->doExport($this->getFixedFileName());
        $this->checkExportedFile($this->getFixedFileName());
    }

    public function testExportWithDefaultName() {
        $this->doExport();
        $this->checkExportedFile($this->getExporter()->getFilePath());
    }

    public function tearDown() {
        parent::tearDown();
        $this->removeCreatedFile($this->getExporter()->getFilePath());
    }

    protected function doExport($filePath = null) {
        $this->createExporter();
        if (isset($filePath)) {
            $this->getExporter()->setFilePath($filePath);
            self::assertEquals($this->getFixedFileName(), $this->getExporter()->getFilePath());
        }
        $this->getExporter()->export();
        self::assertFileExists($this->getExporter()->getFilePath());
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
        $this->checkLine($this->getExporter()->getHeaderRow(), $headRow);
    }

    protected function checkBody($rowsToCheck) {
        foreach ($rowsToCheck as $index => $row) {
            $this->checkLine($this->getTestPoints()[$index], $this->getLineAsArray($row));
        }
    }

    protected function getLineAsArray($line) {
        return explode("|", $line);
    }

    protected function checkLine(AbstractPoint $expectedLine, $actualLine) {
        self::assertEquals($expectedLine->getName(), trim($actualLine[0]));
        self::assertEquals($expectedLine->getTimeCaptured(), trim($actualLine[1]));
        self::assertEquals($expectedLine->getTimeElapsed(), trim($actualLine[2]));
        self::assertEquals($expectedLine->getMemory(), trim($actualLine[3]));
        self::assertEquals($expectedLine->getMemoryHuman(), trim($actualLine[4]));
        self::assertEquals($expectedLine->getMemorySinceStart(), trim($actualLine[5]));
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
