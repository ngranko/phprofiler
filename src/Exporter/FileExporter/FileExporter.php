<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Exporter\Exporter;

abstract class FileExporter extends Exporter {
    /** @var string $filePath */
    protected $filePath;

    public function setFilePath(string $filePath) {
        $this->filePath = $filePath;
    }

    public function getFilePath(): string {
        if (!isset($this->filePath)) {
            $this->filePath = $this->getDefaultFilePath();
        }
        return $this->filePath;
    }

    private function getDefaultFilePath(): string {
        return sprintf('%s/profiler_output_%d.%s', getcwd(), time(), $this->getDefaultExtension());
    }

    abstract protected function getDefaultExtension(): string;
}
