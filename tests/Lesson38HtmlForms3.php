<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverSelect;

class Lesson38HtmlForms extends PHPUnit\Framework\TestCase
{
    protected $webDriver;

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

    public function testForms(): void
    {
        // $this->webDriver->get('');

        $select = new WebDriverSelect($this->webDriver->findElement(WebDriverBy::id('option-element')));
        $select->selectByVisibleText('Option 2');
        // $select->selectByValue('option-2');
        // $select->selectByValue('option-3');

        // $this->assertSame('option-2', $select->getFirstSelectedOption()->getAttribute('value'));
        // $select->deselectAll();

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

        // $this->webDriver->wait()->until(
        //     WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('form-result'))
        // );
        $this->assertContains('The form was sent!', $this->webDriver->getPageSource());
    }

    public function tearDown(): void
    {
        $this->webDriver->quit();
    }
}