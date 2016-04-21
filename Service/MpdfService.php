<?php

namespace Vel\MpdfBundle\Service;

class MpdfService
{
    private $mpdf;

    private $format = 'A4';

    private $fontSize = 0;

    private $marginLeft = 15;

    private $marginRight = 15;

    private $marginTop = 16;

    private $marginBottom = 16;

    private $marginHeader = 9;

    private $marginFooter = 9;

    private $orientation = 'P';

    /**
     * Sets a predefined page size or an array of width and height
     *
     * @param $format
     */
    public function setFormat($format)
    {
        if ((is_array($format) && count($format) == 2) || in_array(strtoupper($format), $this->getAcceptedFormats())) {
            $this->format = $format;
        }
    }

    /**
     * Sets the default document font size in points (pt)
     *
     * @param $fontSize
     */
    public function setFontSize($fontSize)
    {
        $this->fontSize = (int)$fontSize;
    }

    /**
     * Sets page left margin for document in millimeters
     *
     * @param $margin
     */
    public function setMarginLeft($margin)
    {
        $this->marginLeft = (int)$margin;
    }

    /**
     * Sets page right margin for document in millimeters
     *
     * @param $margin
     */
    public function setMarginRight($margin)
    {
        $this->marginRight = (int)$margin;
    }

    /**
     * Sets page top margin for document in millimeters
     *
     * @param $margin
     */
    public function setMarginTop($margin)
    {
        $this->marginTop = (int)$margin;
    }

    /**
     * Sets page bottom margin for document in millimeters
     *
     * @param $margin
     */
    public function setMarginBottom($margin)
    {
        $this->marginBottom = (int)$margin;
    }

    /**
     * Sets page header margin for document in millimeters
     *
     * @param $margin
     */
    public function setMarginHeader($margin)
    {
        $this->marginHeader = (int)$margin;
    }

    /**
     * Sets page footer margin for document in millimeters
     *
     * @param $margin
     */
    public function setMarginFooter($margin)
    {
        $this->marginFooter = (int)$margin;
    }

    /**
     * Set page orientation for document
     *
     * @param $orientation
     */
    public function setOrientation($orientation)
    {
        if (in_array(strtoupper($orientation), array('P', 'L'))) {
            $this->orientation = $orientation;
        }
    }

    public function setHTMLHeader($html)
    {

    }

    public function setHTMLFooter($html)
    {

    }

    public function createMpdfInstance()
    {

    }

    /**
     * @return array
     */
    private function getAcceptedFormats()
    {
        return array(
            'A0', 'A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9', 'A10', 'B0', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6',
            'B7', 'B8', 'B9', 'B10', 'C0', 'C1', 'C2', 'C3', 'C4', '4A0', '2A0', 'RA0', 'RA1', 'RA2', 'RA3', 'RA4',
            'SRA0', 'SRA1', 'SRA2', 'SRA3', 'SRA4', 'Letter', 'Legal', 'Executive', 'Folio',
        );
    }
}