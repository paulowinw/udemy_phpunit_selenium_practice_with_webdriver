<?php
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
trait SetUpConfigs {
    protected static $driver;

    public static function setUpBeforeClass(): void
    {
        $host = 'http://localhost:4444/wd/hub'; // this is the default
        $capabilities = DesiredCapabilities::chrome();

        static::$driver = RemoteWebDriver::create($host, $capabilities);
        static::$driver->get('http://127.0.0.1:5500/src/testingHtmlPage.html');
    }

    public static function tearDownAfterClass(): void
    {
        static::$driver->quit();
    }
}