<?php
namespace PHProfiler\Exporter\FileExporter;

use DOMDocument;
use DOMImplementation;
use DOMAttr;
use DOMElement;
use Exception;
use PHProfiler\Exception\PHProfilerException;
use PHProfiler\Point\AbstractPoint;

class HtmlExporter extends DomFileExporter {
    const STYLESHEET_DIRNAME = '/static/';
    const STYLESHEET_FILENAME = 'phprofilerReport.css';
    const STYLESHEET_RELATIVE_PATH = self::STYLESHEET_DIRNAME . self::STYLESHEET_FILENAME;

    protected function getDefaultExtension(): string {
        return 'html';
    }

    protected function createEmptyDomDocument(): DOMDocument {
        $implementation = new DOMImplementation();
        return $implementation->createDocument(null, null, $implementation->createDocumentType("html"));
    }

    protected function prepareWrapper(): DOMElement {
        $root = $this->dom->appendChild($this->dom->createElement('html'));
        $head = $root->appendChild($this->dom->createElement('head'));
        $head->appendChild($this->dom->createElement('title', 'PHProfiler Report'));
        $head->appendChild($this->createStylesheetLink());
        $body = $root->appendChild($this->dom->createElement('body'));
        $body->appendChild($this->createTable());
        return $this->dom->getElementsByTagName('tbody')->item(0);
    }

    private function createStylesheetLink(): DOMElement {
        $stylesheet = $this->dom->createElement('link');
        $stylesheet->appendChild($this->createAttribute('rel', 'stylesheet'));
        $stylesheet->appendChild($this->createAttribute('href', 'static/phprofilerReport.css'));
        return $stylesheet;
    }

    private function createAttribute(string $name, string $value): DOMAttr {
        $attribute = $this->dom->createAttribute($name);
        $attribute->nodeValue = $value;
        return $attribute;
    }

    private function createTable(): DOMElement {
        $table = $this->dom->createElement('table');
        $table->appendChild($this->createTableHeader());
        $table->appendChild($this->dom->createElement('tbody'));
        return $table;
    }

    private function createTableHeader(): DOMElement {
        $headerValues = $this->getHeaderRow();
        $tableHead = $this->dom->createElement('thead');
        $tableHeadRow = $tableHead->appendChild($this->dom->createElement('tr'));
        foreach ($headerValues->asArray() as $value) {
            $tableHeadRow->appendChild($this->dom->createElement('th', $value));
        }
        return $tableHead;
    }

    protected function preparePoint(AbstractPoint $point): DOMElement {
        $pointNode = $this->dom->createElement('tr');
        foreach ($point->asArray() as $value) {
            $pointNode->appendChild($this->dom->createElement('td', htmlentities($value)));
        }
        return $pointNode;
    }

    protected function writeDocument() {
        try {
            $this->dom->saveHTMLFile($this->getFilePath());
            $this->copyStylesheet(dirname($this->getFilePath()));
        } catch (Exception $e) {
            throw new PHProfilerException(sprintf('Error exporting to a provided file: %s', $this->getFilePath()));
        }
    }

    private function copyStylesheet(string $dirname) {
        if (!file_exists($dirname . self::STYLESHEET_DIRNAME)) {
            mkdir(dirname($this->getFilePath()) . self::STYLESHEET_DIRNAME);
        }
        copy(
            sprintf('%s/../../../assets/%s', __DIR__, self::STYLESHEET_FILENAME),
            $dirname . self::STYLESHEET_RELATIVE_PATH
        );
    }
}
