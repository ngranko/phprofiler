<?php
namespace PHProfilerTests;

use PHProfiler\Exception\PHProfilerException;

trait FileSystemHandler {
    protected function createTestFolderIfNotExists() {
        if (!file_exists(__DIR__ . '/playground')) {
            if (!mkdir(__DIR__ . '/playground')) {
                throw new PHProfilerException('Failed creating a test folder');
            }
        }
    }
}
