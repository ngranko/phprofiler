<?php
namespace PHProfiler\Exporter;

interface ExporterType {
    const LOG = 'log';
    const CSV = 'csv';
    const XML = 'xml';
    const HTML = 'html';
    const SCREEN = 'screen';
}
