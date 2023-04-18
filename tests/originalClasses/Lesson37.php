<?php

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class Lesson37 extends TestCase
{
    // use SetUpConfigs; // Not Working
    protected static $driver;

    public static function setUpBeforeClass(): void
    {
        $host = 'http://localhost:4444/wd/hub'; // this is the default
        $capabilities = DesiredCapabilities::chrome();

        static::$driver = RemoteWebDriver::create($host, $capabilities);
        static::$driver->get('http://127.0.0.1:5500/src/testingHtmlPage.html');
    }

    // public function testGoogle()
    // {
    //     static::$driver->get('https://www.google.com/');
    //     $this->assertEquals('Google', static::$driver->getTitle());
    // }

    public function testGetTitle()
    {
        $this->assertEquals('HTML by Adam Morse, mrmrs.cc', static::$driver->getTitle());
    }

    public static function tearDownAfterClass(): void
    {
        static::$driver->quit();
    }

    // public function setUp()
    // {
    //     $this->setBrowserUrl('http://127.0.0.1:5500/src/testingHtmlPage.html');
    //     $this->setBrowser('chrome');
    //     $this->setDesiredCapabilities(['chromeOptions' => ['w3c' => false]]); // phpunit-selenium does not support W3C mode yet
    // }


    // public function testTitle()
    // {
    //     $this->url('');
    //     $this->assertEquals('HTML by Adam Morse, mrmrs.cc', $this->title());
    // }

    // public function testGettingElements()
    // {
    //     $this->url('');

    //     $h1 = $this->byTag('body'); // p.class  p#id  input[name="myname"]  .alert.alert-danger
    // //     $h1 = $this->byCssSelector('header h1'); // p.class  p#id  input[name="myname"]  .alert.alert-danger
    // //     $this->assertContains('HTML', $h1->text());

    // //     $h1 = $this->elements($this->using('css selector')->value('h1'));
    // //     $this->assertEquals(16, count($h1));
    // //     $this->assertContains('Headings', $h1[2]->text());

    // //     $field = $this->byId('first-name');
    // //     $this->assertSame('Adam', $field->value()); // $field->name()
    // //     $this->assertSame('Adam', $field->attribute('value')); 

    // //     $link = $this->byId('google-link-id'); // $this->byName  $this->byClassName
	// // // $href = $link->attribute('href');
    // //     $this->assertSame('Google', $link->text());

    // //     // $this->clickOnElement('google-link-id');
    // //     $link->click();
    // //     $this->assertEquals('Google', $this->title());
    // //     // $this->url('');
    // //     $this->back();
    // //     // $this->forward();
    // //     $this->refresh();

    // //     $content = $this->byTag('body')->text();
    // //     $this->assertContains('Every html element in one place. Just waiting to be styled.', $content);

    // //     $this->assertContains('At vero eos et accusamus', $this->source());
    // }
}
