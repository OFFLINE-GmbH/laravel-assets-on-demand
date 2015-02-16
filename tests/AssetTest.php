<?php
use Offline\Asset\Asset;

class AssetTest extends PHPUnit_Framework_TestCase
{
    protected $asset;

    protected function setUp()
    {
        $this->asset = new Asset();
    }

    public function testAddJs()
    {
        $this->asset->addJs('file.js');
        $this->assertEquals('<script src="assets/file.js"></script>' . "\n", $this->asset->all());

        $expectedOutput = '<script src="assets/first.js"></script>' . "\n";
        $expectedOutput .= '<script src="assets/file.js"></script>' . "\n";

        $this->asset->addJs('first.js', -10);
        $this->assertEquals($expectedOutput, $this->asset->js());
    }

    public function testAddCss()
    {
        $this->asset->addCss('file.css');
        $this->assertEquals('<link rel="stylesheet" href="assets/file.css" />' . "\n", $this->asset->all());

        $expectedOutput = '<link rel="stylesheet" href="assets/first.css" />' . "\n";
        $expectedOutput .= '<link rel="stylesheet" href="assets/file.css" />' . "\n";

        $this->asset->addCss('first.css', -10);
        $this->assertEquals($expectedOutput, $this->asset->css());
    }

    public function testAddImport()
    {
        $this->asset->addImport('file.html');
        $this->assertEquals('<link rel="import" href="assets/file.html" />' . "\n", $this->asset->all());

        $expectedOutput = '<link rel="import" href="assets/first.html" />' . "\n";
        $expectedOutput .= '<link rel="import" href="assets/file.html" />' . "\n";

        $this->asset->addImport('first.html', -10);
        $this->assertEquals($expectedOutput, $this->asset->all());

        $expectedOutput .= '<link rel="import" href="assets/last.html" />' . "\n";

        $this->asset->addImport('last.html', 10);
        $this->assertEquals($expectedOutput, $this->asset->import());
    }
    public function testPosition()
    {
        $this->asset->addImport('file.html', 0, 'footer');
        $this->assertEquals('' . "\n", $this->asset->all());

        $expectedOutput = '<link rel="import" href="assets/first.html" />' . "\n";
        $expectedOutput .= '<link rel="import" href="assets/file.html" />' . "\n";

        $this->asset->addImport('first.html', -10, 'footer');
        $this->assertEquals($expectedOutput, $this->asset->all('footer'));
    }

}
