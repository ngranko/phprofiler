<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Exporter\Exporter;

abstract class FileExporter extends Exporter {
    protected $filePath;

    public function setFilePath($filePath) {
        $this->filePath = $filePath;
    }

    public function getFilePath() {
        if (!isset($this->filePath)) {
            $this->filePath = $this->getDefaultFilePath();
        }
        return $this->filePath;
    }

    protected function getDefaultFilePath() {
        return sprintf('%s/profiler_output_%d.%s', getcwd(), time(), $this->getDefaultExtension());
    }

    abstract protected function getDefaultExtension();
}
