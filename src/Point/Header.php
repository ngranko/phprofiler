<?php
namespace PHProfiler\Point;

class Header extends AbstractPoint {
    public function __construct() {
        $this->name = 'Point Name';
        $this->timeCaptured = 'Point captured on';
        $this->timeElapsed = 'Time from start (sec)';
        $this->memory = 'Memory used (b)';
        $this->memoryHuman = 'Memory used';
        $this->memorySinceStart = 'Memory compared to start (b)';
    }
}
