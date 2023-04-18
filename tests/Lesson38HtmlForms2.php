<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverSelect;
use PHPUnit\Framework\TestCase;

class Lesson38HtmlForms extends TestCase
{
    private $webDriver;

    public function setUp(): void
    {
        $this->webDriver = RemoteWebDriver::create(
            'http://localhost:4444/wd/hub',
            [
                'platform' => 'WINDOWS',
                'browserName' => 'chrome',
                'chromeOptions' => [
                    'w3c' => false,
                ],
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

        $optionElement = new WebDriverSelect($this->webDriver->findElement(WebDriverBy::id('option-element')));
        $optionElement->selectByVisibleText('Option 2');
        // $optionElement->selectByValue('option-2');
        // $optionElement->selectByValue('option-3');
        $this->assertSame('option-2', $optionElement->getFirstSelectedOption()->getAttribute('value'));
        $optionElement->deselectAll();

        $usernameInput = $this->webDriver->findElement(WebDriverBy::name('some_input_name'));
        $usernameInput->sendKeys('Adam');
        // $usernameInput->clear();
        $this->assertSame('Adam', $usernameInput->getAttribute('value'));

        $radios = $this->webDriver->findElements(WebDriverBy::cssSelector('input[type="radio"]'));
        $radios[0]->click();

        $this->webDriver->findElement(WebDriverBy::cssSelector('input[type="checkbox"]'))->click();
        
        $this->webDriver->findElement(WebDriverBy::tagName('textarea'))->sendKeys('Some text');

        $this->webDriver->findElement(WebDriverBy::id('submit-button'))->click();
        // $this->webDriver->findElement(WebDriverBy::id('submit-button'))->submit(); // does not care about frontend validation
        $this->assertStringContainsString('The form was sent!', $this->webDriver->getPageSource());
    }
}