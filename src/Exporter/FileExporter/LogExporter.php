<?php
namespace PHProfiler\Exporter\FileExporter;

use PHProfiler\Point\AbstractPoint;

class LogExporter extends StringFileExporter {
    protected function getDefaultExtension() {
        return 'log';
    }

    protected function writePoint($point, $filePointer) {
        fprintf($filePointer, $this->preparePoint($point));
    }

    protected function preparePoint(AbstractPoint $point) {
        return sprintf(
            "%-28s | %28s | %28s | %28s | %28s | %28s\n",
            $point->getName(),
            $point->getTimeCaptured(),
            $point->getTimeSinceStart(),
            $point->getMemory(),
            $point->getMemoryHuman(),
            $point->getMemorySinceStart()
        );
    }
}
