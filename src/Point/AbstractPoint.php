<?php
namespace PHProfiler\Point;

abstract class AbstractPoint {
    /** @var string $name */
    protected $name;
    /** @var string $timeCaptured */
    protected $timeCaptured;
    /** @var string $timeElapsed */
    protected $timeElapsed;
    /** @var string $memory */
    protected $memory;
    /** @var string $memoryHuman */
    protected $memoryHuman;
    /** @var string $memorySinceStart */
    protected $memorySinceStart;

    public function asArray(): array {
        return [
            'name' => $this->getName(),
            'time_captured' => $this->getTimeCaptured(),
            'time_since_start' => $this->getTimeSinceStart(),
            'memory' => $this->getMemory(),
            'memory_human' => $this->getMemoryHuman(),
            'memory_since_start' => $this->getMemorySinceStart(),
        ];
    }

    public function __toString(): string {
        return sprintf(
            '%-28s | %28s | %28s | %28s | %28s | %28s',
            $this->getName(),
            $this->getTimeCaptured(),
            $this->getTimeSinceStart(),
            $this->getMemory(),
            $this->getMemoryHuman(),
            $this->getMemorySinceStart()
        );
    }

    public function getName(): string {
        return $this->name;
    }

    public function getTimeCaptured(): string {
        return $this->timeCaptured;
    }

    public function getTimeSinceStart(): string {
        return $this->timeElapsed;
    }

    public function getMemory(): string {
        return $this->memory;
    }

    public function getMemoryHuman(): string {
        return $this->memoryHuman;
    }

    public function getMemorySinceStart(): string {
        return $this->memorySinceStart;
    }
}
