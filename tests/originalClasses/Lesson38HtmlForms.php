<?php


class HtmlFormsTest extends PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setBrowserUrl('http://127.0.0.1:5500/src/testingHtmlPage.html');
        $this->setBrowser('chrome');
        $this->setDesiredCapabilities(['chromeOptions' => ['w3c' => false]]); // phpunit-selenium does not support W3C mode yet
    }

    public function testForms()
    {
        $this->url('');

        $this->select($this->byId('option-element'))->selectOptionByLabel("Option 2");
        // $this->select($this->byId('option-element'))->selectOptionByValue("option-2");
        // $this->select($this->byId('option-element'))->selectOptionByValue("option-3");
        $this->assertSame('option-2', $this->select($this->byId('option-element'))->selectedValue());
        $this->select($this->byId('option-element'))->clearSelectedOptions();

        $usernameInput = $this->byName('some_input_name');
        $usernameInput->value("Adam");
        // $usernameInput->clear();
        $this->assertSame('Adam', $usernameInput->value());

        $radios = $this->elements($this->using('css selector')->value('input[type="radio"]'));
        $radios[0]->click();

        $this->byCssSelector('input[type="checkbox"]')->click();
        
        $this->byTag('textarea')->value('Some text');

        $this->clickOnElement('submit-button');
        // $this->byId('submit-button')->submit(); // does not care about frontend validation
        $this->assertContains('The form was sent!', $this->source());
        
    }
}
