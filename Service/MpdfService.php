<?php

namespace Vel\MpdfBundle\Service;

use Symfony\Component\HttpFoundation\Response;

class MpdfService
{
    private $mpdf;

    /**
     * Create new mPDF instance.
     *
     * $mpdf = new mPDF(
     * '',  mode - default ''
     * '',  format - A4, for example, default ''
     * 0,   font size - default 0
     * '',  default font family
     * 15,  margin_left
     * 15,  margin right
     * 16,  margin top
     * 16,  margin bottom
     * 9,   margin header
     * 9,   margin footer
     * 'L'  L - landscape, P - portrait
     * );
     *
     *
     * @param string $format
     * @param int    $fontSize
     * @param string $fontFamily
     * @param int    $marginLeft
     * @param int    $marginRight
     * @param int    $marginTop
     * @param int    $marginBottom
     * @param int    $marginHeader
     * @param int    $marginFooter
     * @param string $orientation
     */

    public function createMpdfInstance(
        $format = 'A4',
        $fontSize = 0,
        $fontFamily = '',
        $marginLeft = 15,
        $marginRight = 15,
        $marginTop = 16,
        $marginBottom = 16,
        $marginHeader = 9,
        $marginFooter = 9,
        $orientation = 'P'
    )
    {
        if (!(is_array($format) && count($format) == 2) || !in_array(strtoupper($format), $this->getAcceptedFormats())) {
            $format = 'A4';
        }

        $constructorArgs = array(
            'utf-8',
            $this->validateFormat($format),
            (int)$fontSize,
            $fontFamily,
            (int)$marginLeft,
            (int)$marginRight,
            (int)$marginTop,
            (int)$marginBottom,
            (int)$marginHeader,
            (int)$marginFooter,
            $this->validateOrientation($orientation));

        $reflection = new \ReflectionClass('\mPDF');
        $this->mpdf = $reflection->newInstanceArgs($constructorArgs);
    }


    /**
     * @return object
     */
    public function getMpdf()
    {
        if(null == $this->mpdf) {
	    $this->createMpdfInstance();
        }
        return $this->mpdf;
    }

    /**
     * @param       $html
     * @param array $argOptions
     *
     * @return mixed
     */
    public function generatePDF($html, $argOptions = array())
    {
        $defaultOptions = array(
            'outputFilename'    => '',
            'outputDestination' => 'S',
        );

        $options = array_merge($defaultOptions, $argOptions);
        $this->getMpdf()->WriteHTML($html);

        return $this->getMpdf()->Output($options['outputFilename'], $options['outputDestination']);
    }

    /**
     * @param       $html
     * @param array $args
     *
     * @return Response
     */
    public function generatePDFResponseFromHTML($html, array $args = array())
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/pdf');

        $response->setContent(
            $this->generatePDF($html, $args)
        );

        return $response;
    }

    /**
     * @param $format
     *
     * @return array|string
     */
    private function validateFormat($format)
    {
        if (is_array($format) && count($format) == 2) {
            $validatedFormat = array();
            foreach ($format as $length) {
                $validatedFormat[] = (float)$length;
            }

            return $validatedFormat;
        }
        if (in_array(strtoupper($format), $this->getAcceptedFormats())) {
            return $format;
        }

        return 'A4';
    }

    /**
     * Validate page orientation for document
     *
     * @param $orientation
     *
     * @return string
     */

    private function validateOrientation($orientation)
    {
        if (in_array(strtoupper($orientation), array('P', 'L'))) {
            return $orientation;
        }

        return 'P';
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