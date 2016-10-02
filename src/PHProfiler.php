<?php
namespace PHProfiler;

use PHProfiler\Exporter\CsvFileExporter;
use PHProfiler\Exporter\ExporterFactory;
use PHProfiler\Exporter\LogFileExporter;
use PHProfiler\Point\AbstractPoint;
use PHProfiler\Point\Point;

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
        $this->rememberedPoints[] = new Point($pointName, $this->startTime, $this->startMemory);
    }

    private function getPointName($providedName = null) {
        $name = $providedName;
        if (is_null($name)) {
            $name = $this->getUniquePointName('point');
        }
        return $name;
    }

    private function getUniquePointName($nameBase) {
        $nameSuffix = 0;
        while ($this->isNameAlreadyTaken($nameBase . $nameSuffix)) {
            $nameSuffix++;
        }
        return $nameBase . $nameSuffix;
    }

    private function isNameAlreadyTaken($name) {
        $count = count(array_filter($this->rememberedPoints, function(AbstractPoint $element) use ($name) {
            return $element->getName() === $name;
        }));

        return $count > 0;
    }

    public function export($type, $filePath = null) {
        $exporter = ExporterFactory::getExporter($type, $this->rememberedPoints);
        if (method_exists($exporter, 'setFilePath')) {
            $exporter->setFilePath($filePath);
        }
        $exporter->export();
    }
}
