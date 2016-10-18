<?php
namespace PHProfilerTests;

abstract class AbstractStringFileExporterTest extends AbstractFileExporterTest {
    protected function checkExportedFile($filePath) {
        $fileRows = $this->getLinesFromFile($filePath);
        self::assertCount(5, $fileRows);
        $this->checkHead(array_shift($fileRows));
        $this->checkBody($fileRows);
    }

    protected function getLinesFromFile($filePath) {
        return array_filter(explode("\n", file_get_contents($filePath)));
    }

    protected function checkHead($headRow) {
        $this->checkPoint($this->getExporter()->getHeaderRow(), $this->toArray($headRow));
    }

    protected function checkBody($rowsToCheck) {
        foreach ($rowsToCheck as $index => $row) {
            $this->checkPoint($this->getTestPoints()[$index], $this->toArray($row));
        }
    }
}
