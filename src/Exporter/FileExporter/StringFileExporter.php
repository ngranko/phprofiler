<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Exception\PHProfilerException;

abstract class StringFileExporter extends FileExporter {
    protected $filePointer;

    public function export() {
        $this->filePointer = $this->openFileForWriting($this->getFilePath());
        $this->writeDataToFile();
        $this->closeFile();
    }

    protected function openFileForWriting($filePath) {
        $pointer = fopen($filePath, 'w');
        if ($pointer === false) {
            throw new PHProfilerException(sprintf('Error opening provided file: %s', $filePath));
        }
        return $pointer;
    }

    protected function writeDataToFile() {
        if (!isset($this->filePointer)) {
            throw new PHProfilerException('Attempting to write data to a file before opening it for writing');
        }
        $this->exportHeader();
        $this->exportPoints();
    }

    protected function closeFile() {
        fclose($this->filePointer);
    }
}
