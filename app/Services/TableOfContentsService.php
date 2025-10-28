<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;

class TableOfContentsService
{
    /**
     * Generate table of contents from HTML content
     * 
     * @param string $html The HTML content to parse
     * @return array ['html' => string, 'toc' => array]
     */
    public function generateTableOfContents(string $html): array
    {
        if (empty($html)) {
            return ['html' => '', 'toc' => []];
        }

        // Suppress warnings for malformed HTML
        libxml_use_internal_errors(true);
        
        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        libxml_clear_errors();
        libxml_use_internal_errors(false);

        $headings = $this->extractHeadings($dom);
        
        if (empty($headings)) {
            return ['html' => $html, 'toc' => []];
        }

        // Generate ToC structure
        $toc = $this->buildTocStructure($headings);
        
        // Inject anchor IDs back into the HTML
        $this->injectAnchors($dom, $headings);
        
        // Convert DOM back to HTML
        $modifiedHtml = $this->domToHtml($dom);
        
        return [
            'html' => $modifiedHtml,
            'toc' => $toc
        ];
    }

    /**
     * Extract heading elements from DOM
     * 
     * @param DOMDocument $dom
     * @return array Array of heading data ['element' => DOMElement, 'text' => string, 'level' => int, 'id' => string]
     */
    protected function extractHeadings(DOMDocument $dom): array
    {
        $headings = [];
        $xpath = new DOMXPath($dom);
        
        // Query for h2, h3, h4 headings
        $nodes = $xpath->query('//h2 | //h3 | //h4');
        
        if ($nodes === false || $nodes->length === 0) {
            return [];
        }

        $usedIds = [];
        
        foreach ($nodes as $element) {
            $text = trim($element->textContent);
            $tagName = $element->tagName;
            $level = (int) substr($tagName, 1); // Extract number from h2, h3, h4
            
            $anchorId = $this->generateAnchorId($text, $usedIds, $level);
            
            $headings[] = [
                'element' => $element,
                'text' => $text,
                'level' => $level,
                'id' => $anchorId
            ];
        }
        
        return $headings;
    }

    /**
     * Generate a unique anchor ID from heading text
     * 
     * @param string $text Heading text
     * @param array $usedIds Array of already used IDs (passed by reference)
     * @param int $level Heading level (2, 3, or 4)
     * @return string Unique anchor ID
     */
    protected function generateAnchorId(string $text, array &$usedIds, int $level): string
    {
        // Convert to slug
        $slug = $this->slugify($text);
        
        // Prepend level
        $id = "h{$level}-{$slug}";
        
        // Handle duplicates
        if (in_array($id, $usedIds)) {
            $counter = 2;
            while (in_array("{$id}-{$counter}", $usedIds)) {
                $counter++;
            }
            $id = "{$id}-{$counter}";
        }
        
        $usedIds[] = $id;
        
        return $id;
    }

    /**
     * Convert text to URL-friendly slug
     * 
     * @param string $text
     * @return string
     */
    protected function slugify(string $text): string
    {
        // Convert to lowercase
        $text = mb_strtolower($text, 'UTF-8');
        
        // Replace spaces and common punctuation with hyphens
        $text = preg_replace('/[^\pL\d]+/u', '-', $text);
        
        // Remove leading/trailing hyphens
        $text = trim($text, '-');
        
        // Return or default to 'heading' if empty
        return $text ?: 'heading';
    }

    /**
     * Build nested ToC structure from headings
     * 
     * @param array $headings
     * @return array Nested ToC structure
     */
    protected function buildTocStructure(array $headings): array
    {
        $toc = [];
        
        foreach ($headings as $heading) {
            $toc[] = [
                'id' => $heading['id'],
                'text' => $heading['text'],
                'level' => $heading['level']
            ];
        }
        
        return $toc;
    }

    /**
     * Inject anchor IDs into heading elements
     * 
     * @param DOMDocument $dom
     * @param array $headings
     */
    protected function injectAnchors(DOMDocument $dom, array $headings): void
    {
        foreach ($headings as $heading) {
            /** @var \DOMElement $element */
            $element = $heading['element'];
            $id = $heading['id'];
            
            $element->setAttribute('id', $id);
        }
    }

    /**
     * Convert DOMDocument back to HTML string
     * 
     * @param DOMDocument $dom
     * @return string
     */
    protected function domToHtml(DOMDocument $dom): string
    {
        $html = '';
        
        // Get body content or direct children
        $body = $dom->getElementsByTagName('body');
        
        if ($body->length > 0) {
            $bodyNodes = $body->item(0)->childNodes;
            foreach ($bodyNodes as $node) {
                $html .= $dom->saveHTML($node);
            }
        } else {
            // If no body tag, get all children
            foreach ($dom->childNodes as $node) {
                $html .= $dom->saveHTML($node);
            }
        }
        
        return $html;
    }
}

