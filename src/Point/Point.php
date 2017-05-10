<?php
namespace PHProfiler\Point;

use DateTime;

class Point extends AbstractPoint {
    public function __construct(string $pointName, string $startTime, string $startMemory) {
        $currentTime = microtime(true);
        $currentMemory = memory_get_usage();
        $this->name = $pointName;
        $this->timeCaptured = $this->getFormattedTime($currentTime);
        $this->timeElapsed = number_format($currentTime - $startTime, 6, '.', '');
        $this->memory = (string) $currentMemory;
        $this->memoryHuman = $this->getReadableMemoryUsage($currentMemory);
        $this->memorySinceStart = $currentMemory - $startMemory;
    }

    private function getFormattedTime(float $time): string {
        $now = DateTime::createFromFormat('U.u', $time);
        return $now->format("m-d-Y H:i:s.u");
    }

    private function getReadableMemoryUsage(float $memory): string {
        $units = [" Bytes", " KB", " MB", " GB", " TB"];
        $power = (int) floor(log($memory, 1024));
        return $memory ? round($memory / pow(1024, $power), 2) . $units[$power] : '0 Bytes';
    }
}
