<?php
namespace PHProfiler;

use PHProfiler\Exporter\ExporterFactory;
use PHProfiler\Point\AbstractPoint;
use PHProfiler\Point\Point;

class PHProfiler {
    /** @var float $startTime */
    private $startTime;
    /** @var string $startMemory */
    private $startMemory;
    /** @var array $rememberedPoints */
    protected $rememberedPoints;

    public function __construct() {
        $this->startTime = microtime(true);
        $this->startMemory = memory_get_usage();
        $this->rememberedPoints = [];
    }

    public function rememberPoint(string $name = null): PHProfiler {
        $pointName = $this->getPointName($name);
        $this->rememberedPoints[] = new Point($pointName, $this->startTime, $this->startMemory);
        return $this;
    }

    private function getPointName(string $providedName = null): string {
        return is_null($providedName) ? $this->getUniquePointName('point') : $providedName;
    }

    private function getUniquePointName(string $nameBase): string {
        $nameSuffix = 0;
        while ($this->isNameAlreadyTaken($nameBase . $nameSuffix)) {
            $nameSuffix++;
        }
        return $nameBase . $nameSuffix;
    }

    private function isNameAlreadyTaken(string $name): bool {
        $count = count(array_filter($this->rememberedPoints, function(AbstractPoint $element) use ($name) {
            return $element->getName() === $name;
        }));

        return $count > 0;
    }

    public function export(string $type, string $filePath = null) {
        $exporter = ExporterFactory::getExporter($type, $this->rememberedPoints);
        if (method_exists($exporter, 'setFilePath')) {
            $exporter->setFilePath($filePath);
        }
        $exporter->export();
    }
}
