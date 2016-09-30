<?php
namespace PHProfilerTests\Testers;

use PHProfiler\PHProfiler;
use PHProfiler\Point\AbstractPoint;

class PHProfilerTester extends PHProfiler {
    /**
     * @return AbstractPoint[]
     */
    public function getRememberedPoints() {
        return $this->rememberedPoints;
    }
}
