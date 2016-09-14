<?php
namespace PHProfiler;

use PHProfiler\Exporter\CsvFileExporter;
use PHProfiler\Exporter\LogFileExporter;

class PHProfiler {
    private $startTime;
    private $startMemory;
    protected $rememberedPoints;

    private function __construct($startTime, $startMemoryUsed) {
        $this->startTime = $startTime;
        $this->startMemory = $startMemoryUsed;
        $this->rememberedPoints = [];
    }

    public static function initialize() {
        return new static(microtime(true), memory_get_usage());
    }

    public function rememberPoint($name = null) {
        $pointName = $this->getPointName($name);
        $this->rememberedPoints[] = [
            'name' => $pointName,
            'time' => microtime(true) - $this->startTime,
            'memory' => memory_get_usage() - $this->startMemory,
        ];
    }

    private function getPointName($providedName = null) {
        $name = $providedName;
        if (is_null($name)) {
            $name = $this->getUniquePointName('point');
        }
        return $name;
    }

    private function getUniquePointName($nameBase) {
        $i = 0;
        while (array_search($nameBase . $i, array_column($this->rememberedPoints, 'name')) !== false) {
            $i++;
        }
        return $nameBase . $i;
    }

    public function exportToLogFile($providedFilePath = null) {
        $exporter = new LogFileExporter($this->rememberedPoints);
        $exporter->setFilePath($providedFilePath);
        $exporter->export();
    }

    public function exportToCsvFile($providedFilePath = null) {
        $exporter = new CsvFileExporter($this->rememberedPoints);
        $exporter->setFilePath($providedFilePath);
        $exporter->export();
    }
}
