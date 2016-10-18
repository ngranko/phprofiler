<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Exception\PHProfilerException;

abstract class StringFileExporter extends FileExporter {
    public function export() {
        $filePointer = $this->openFileForWriting($this->getFilePath());
        $this->writeDataToFile($filePointer);
        $this->closeFile($filePointer);
    }

    protected function openFileForWriting($filePath) {
        $pointer = fopen($filePath, 'w');
        if ($pointer === false) {
            throw new PHProfilerException(sprintf('Error opening provided file: %s', $filePath));
        }
        return $pointer;
    }

    protected function writeDataToFile($filePointer) {
        $this->writeHeader($filePointer);
        $this->writePoints($filePointer);
    }

    protected function writeHeader($filePointer) {
        $this->writePoint($this->getHeaderRow(), $filePointer);
    }

    protected function writePoints($filePointer) {
        foreach ($this->getPrintData() as $point) {
            $this->writePoint($point, $filePointer);
        }
    }

    protected function closeFile($filePointer) {
        fclose($filePointer);
    }

    abstract protected function writePoint($point, $filePointer);
}
