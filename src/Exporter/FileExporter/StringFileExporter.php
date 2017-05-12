<?php
namespace PHProfiler\Exporter\FileExporter;

use Exception;
use PHProfiler\Exception\PHProfilerException;

abstract class StringFileExporter extends FileExporter {
    /** @var resource $filePointer */
    protected $filePointer;

    public function export() {
        $this->openFileForWriting($this->getFilePath());
        $this->writeDataToFile();
        $this->closeFile();
    }

    protected function openFileForWriting(string $filePath) {
        try {
            $pointer = fopen($filePath, 'w');
        } catch (Exception $e) {
            throw new PHProfilerException(sprintf('Error opening provided file: %s', $filePath));
        }
        $this->filePointer = $pointer;
    }

    protected function writeDataToFile() {
        if (!is_resource($this->filePointer)) {
            throw new PHProfilerException('File resource is empty');
        }
        $this->exportHeader();
        $this->exportPoints();
    }

    protected function closeFile() {
        fclose($this->filePointer);
    }
}
