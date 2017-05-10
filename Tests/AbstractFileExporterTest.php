<?php
namespace PHProfilerTests;

use org\bovigo\vfs\vfsStream;

abstract class AbstractFileExporterTest extends AbstractExporterTest {
    protected $fixedFileName;

    public function setUp() {
        parent::setUp();
        vfsStream::setup('playground');
    }

    public function testGetFilePath() {
        $this->createExporter();
        $this->getExporter()->setFilePath($this->getTestFilepath());
        self::assertEquals($this->getTestFilepath(), $this->getExporter()->getFilePath());
    }

    public function testExport() {
        $this->doExport($this->getTestFilepath());
        $this->checkExportedFile($this->getTestFilepath());
    }

    protected function doExport($filePath = null) {
        $this->createExporter();
        if (isset($filePath)) {
            $this->getExporter()->setFilePath($filePath);
            self::assertEquals($filePath, $this->getExporter()->getFilePath());
        }
        $this->getExporter()->export();
        self::assertFileExists($this->getExporter()->getFilePath());
    }

    abstract protected function checkExportedFile($filePath);

    protected function getTestFilepath() {
        return vfsStream::url('playground') . DIRECTORY_SEPARATOR . $this->fixedFileName;
    }
}
