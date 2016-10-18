<?php
namespace PHProfiler\Point;

abstract class AbstractPoint {
    protected $name;
    protected $timeCaptured;
    protected $timeElapsed;
    protected $memory;
    protected $memoryHuman;
    protected $memorySinceStart;

    protected function __construct() {}

    public function asArray() {
        return [
            $this->getName(),
            $this->getTimeCaptured(),
            $this->getTimeSinceStart(),
            $this->getMemory(),
            $this->getMemoryHuman(),
            $this->getMemorySinceStart(),
        ];
    }

    public function getName() {
        return $this->name;
    }

    public function getTimeCaptured() {
        return $this->timeCaptured;
    }

    public function getTimeSinceStart() {
        return $this->timeElapsed;
    }

    public function getMemory() {
        return $this->memory;
    }

    public function getMemoryHuman() {
        return $this->memoryHuman;
    }

    public function getMemorySinceStart() {
        return $this->memorySinceStart;
    }
}
