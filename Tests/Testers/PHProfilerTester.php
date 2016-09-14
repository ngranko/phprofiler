<?php
namespace PHProfilerTests\Testers;

use PHProfiler\PHProfiler;

class PHProfilerTester extends PHProfiler {
    public function getRememberedPoints() {
        return $this->rememberedPoints;
    }
}
