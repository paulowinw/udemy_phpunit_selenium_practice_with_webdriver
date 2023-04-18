<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class Lesson39HtmlFormsTest extends PHPUnit\Framework\TestCase
{
    /**
     * @var RemoteWebDriver
     */
    protected $webDriver;

    public function setUp(): void
    {
        $this->webDriver = RemoteWebDriver::create(
            'http://localhost:4444/wd/hub',
            [
                'platform' => 'ANY',
                'browserName' => 'chrome',
                'chromeOptions' => ['w3c' => false]
            ]
        );
        $this->webDriver->get('http://127.0.0.1:5500/src/testingHtmlPage.html');
    }

    public function tearDown(): void
    {
        $this->webDriver->quit();
    }

    public function testForms()
    {
        // $this->webDriver->get('');

        $optionElement = $this->webDriver->findElement(WebDriverBy::id('option-element'));
        $optionElement->findElement(WebDriverBy::xpath('.//option[text()="Option 2"]'))->click();
        $this->assertSame('option-2', $optionElement->getAttribute('value'));
        // $optionElement->clear();

        $usernameInput = $this->webDriver->findElement(WebDriverBy::name('some_input_name'));
        $usernameInput->sendKeys('Adam');
        $this->assertSame('Adam', $usernameInput->getAttribute('value'));

        $radios = $this->webDriver->findElements(WebDriverBy::cssSelector('input[type="radio"]'));
        $radios[0]->click();

        $this->webDriver->findElement(WebDriverBy::cssSelector('input[type="checkbox"]'))->click();

        $this->webDriver->findElement(WebDriverBy::tagName('textarea'))->sendKeys('Some text');

        $this->webDriver->findElement(WebDriverBy::id('submit-button'))->click();
        $this->assertStringContainsString('The form was sent!', $this->webDriver->getPageSource());
    }

    public function testAnother()
    {
        $this->assertSame('John', 'John');

        // $this->webDriver->get('');
        $this->webDriver->manage()->addCookie(['name' => 'user', 'value' => 'logged-in']);
        $authCookie = $this->webDriver->manage()->getCookieNamed('user');
        $this->assertSame('logged-in', $authCookie->getValue());
    }
}