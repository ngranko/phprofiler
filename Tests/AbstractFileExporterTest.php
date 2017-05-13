<?php
namespace PHProfilerTests;

use org\bovigo\vfs\vfsStream;
use PHProfiler\Exception\PHProfilerException;
use PHProfiler\Exporter\FileExporter\FileExporter;

abstract class AbstractFileExporterTest extends AbstractExporterTest {
    /** @var string $fixedFileName */
    protected $fixedFileName;

    public function setUp() {
        parent::setUp();
        vfsStream::setup('playground');
    }

    public function testGetDefaultFilePath() {
        /** @var FileExporter $exporter */
        $exporter = $this->getExporter();
        self::assertRegExp(sprintf('~%s/profiler_output_[0-9]+.[a-z]+~', getcwd()), $exporter->getFilePath());
    }

    public function testGetFilePath() {
        /** @var FileExporter $exporter */
        $exporter = $this->getExporter();
        $exporter->setFilePath($this->getTestFilepath());
        self::assertEquals($this->getTestFilepath(), $exporter->getFilePath());
    }

    public function testExport() {
        $this->doExport($this->getTestFilepath());
        $this->checkExportedFile($this->getTestFilepath());
    }

    public function testFailedExport() {
        $this->expectException(PHProfilerException::class);
        $this->doExport(vfsStream::url('fail'));
    }

    protected function doExport(string $filePath = null) {
        /** @var FileExporter $exporter */
        $exporter = $this->getExporter();
        if (isset($filePath)) {
            $exporter->setFilePath($filePath);
            self::assertEquals($filePath, $exporter->getFilePath());
        }
        $this->getExporter()->export();
        self::assertFileExists($exporter->getFilePath());
    }

    abstract protected function checkExportedFile(string $filePath);

    protected function getTestFilepath(): string {
        return sprintf('%s/%s', vfsStream::url('playground'), $this->fixedFileName);
    }
}
