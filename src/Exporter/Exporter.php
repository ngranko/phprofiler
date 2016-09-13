<?php
namespace PHProfiler\Exporter;

abstract class Exporter {
    protected $printData;

    public function __construct($printData) {
        $this->printData = $printData;
    }

    abstract public function export();

    public function getHeaderRow() {
        return [
            'isHeader' => true,
            'name' => 'Point Name',
            'time' => 'Time (sec)',
            'memory' => 'Memory Used (b)',
        ];
    }

    protected function prepareRow($row) {
        return isset($row['isHeader']) ? $this->prepareHeaderRow($row) : $this->prepareBodyRow($row);
    }

    protected function prepareHeaderRow($row) {
        return sprintf("%s\t\t%s\t\t%s\n", $row['name'], $row['time'], $row['memory']);
    }

    protected function prepareBodyRow($row) {
        return sprintf("%s\t\t%f\t\t%d\n", $row['name'], $row['time'], $row['memory']);
    }
}
