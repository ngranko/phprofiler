<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Exception\PHProfilerException;
use PHProfiler\Exporter\Exporter;

abstract class FileExporter extends Exporter {
    protected $filePath;

    public function setFilePath($filePath) {
        $this->filePath = $filePath;
    }

    public function export() {
        $filePointer = $this->getFilePointer($this->getFinalFilePath());

        $this->printPoint($filePointer, $this->getHeaderRow());

        foreach ($this->printData as $point) {
            $this->printPoint($filePointer, $point);
        }

        $this->closeFilePointer($filePointer);
    }

    protected function getFilePointer($filePath) {
        $pointer = fopen($filePath, 'w');
        if ($pointer === false) {
            throw new PHProfilerException(sprintf('Error opening provided file: %s', $filePath));
        }
        return $pointer;
    }

    protected function getFinalFilePath() {
        if (!isset($this->filePath)) {
            $this->filePath = $this->getDefaultFilePath();
        }
        return $this->filePath;
    }

    protected function getDefaultFilePath() {
        return sprintf('%s/profiler_output_%d.%s', getcwd(), time(), $this->getDefaultExtension());
    }

    abstract protected function getDefaultExtension();

    abstract protected function printPoint($filePointer, $point);

    protected function closeFilePointer($pointer) {
        fclose($pointer);
    }
}
