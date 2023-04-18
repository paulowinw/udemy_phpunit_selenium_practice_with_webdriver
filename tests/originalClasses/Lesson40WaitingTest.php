<?php


class WaitingTest extends PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setBrowserUrl('http://127.0.0.1:5500/src/testingHtmlPage.html');
        $this->setBrowser('chrome');
        $this->setDesiredCapabilities(['chromeOptions' => ['w3c' => false]]); // phpunit-selenium does not support W3C mode yet

    }


    public function testExplicitWait()
    {
        $driver = $this;
        $this->url('');
        $this->waitUntil(function() use($driver)   {
                $item = $driver->byId('first-name');
                if ($item->value() === 'Adam') return true;
                return null;
        }, 4000);

        $this->assertSame('Adam', $this->byId('first-name')->value());

    }


}
