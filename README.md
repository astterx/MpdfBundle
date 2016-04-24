MpdfBundle is a wrapper service for mPDF class, created for Symfony projects.
### Installation (Symfony 2.x, Symfony 3.0.x)

* Add a new line to your ```composer.json``` file:

```
"require": {
    ...
    "vel/mpdf-bundle": "dev-master"
}
```
* Run composer update command
```
php composer.phar update
```
* Add a new line to ```app/AppKernel.php```:
```
$bundles = array(
...
new Vel\MpdfBundle\VelMpdfBundle(),
)
```

### Documentation
#### Create Response object
This example creates a PDF document from HTML code with default options (font, font size, margins, orientation):
```
$mpdfService = $this->get('vel.mpdf');
$html = '<h2>Hello world</h2>';
$respose = $mpdfService->generatePDFResponseFromHTML($html);
```
#### Generate PDF content and keep it into a string variable
```
$mpdfService = $this->get('vel.mpdf');
$html = '<h2>Hello world</h2>';
$content = $mpdfService->generatePDF($html);
````
#### Use different options to generate a PDF document with text header and HTML footer
```
$mpdfService = $this->get('vel.mpdf');
$mpdfService->createMpdfInstance(
        $format = 'A4',
        $fontSize = 0, //default
        $fontFamily = '', //default
        $marginLeft = 15,
        $marginRight = 15,
        $marginTop = 16,
        $marginBottom = 16,
        $marginHeader = 9,
        $marginFooter = 9,
        $orientation = 'P' // P for portrait, L for landscape
      );
$mpdfService->getMpdf()->setHeader('Text header');
$mpdfService->getMpdf()->setHTMLFooter('<h6>Footer text</h6>');
$html = '<h2>Hello world</h2>';
$mpdfService->generatePDFResponseFromHTML($html)
```
By default the bundle add 'utf-8' to mPDF constructor class.
