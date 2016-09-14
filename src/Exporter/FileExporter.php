<?php
namespace PHProfiler\Exporter;

use PHProfiler\Exception\PHProfilerException;

abstract class FileExporter extends Exporter {
    protected $filePath;

    public function setFilePath($filePath) {
        $this->filePath = $filePath;
    }

    public function export() {
        $filePointer = $this->getFilePointer($this->getFinalFilePath());

        $this->printRow($filePointer, $this->getHeaderRow());

        foreach ($this->printData as $point) {
            $this->printRow($filePointer, $point);
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
        if (is_null($this->filePath)) {
            $this->filePath = sprintf('%s/profiler_output_%d.%s', getcwd(), time(), $this->getDefaultExtension());
        }
        return $this->filePath;
    }

    abstract protected function getDefaultExtension();

    abstract protected function printRow($filePointer, $row);

    protected function closeFilePointer($pointer) {
        fclose($pointer);
    }
}
