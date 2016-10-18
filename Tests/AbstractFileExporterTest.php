<?php
namespace PHProfilerTests;

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

    abstract protected function checkExportedFile($filePath);

    protected function getFixedFileName() {
        return $this->fixedFileName;
    }

    private function removeCreatedFile($path) {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
