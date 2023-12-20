<?php

namespace Winter\Location\Tests\Feature;

use Winter\Location\Models\Country;
use System\Tests\Bootstrap\PluginTestCase;

class LocationIsoTest extends PluginTestCase
{
    public function testGetCountryIso()
    {
        $country = Country::whereCode('US')->first();
        $isoAttributes = $country->iso;

        $this->assertIsArray($isoAttributes);
        $this->assertArrayHasKey('name', $isoAttributes);
        $this->assertArrayHasKey('alpha2', $isoAttributes);
        $this->assertArrayHasKey('alpha3', $isoAttributes);
        $this->assertArrayHasKey('numeric', $isoAttributes);
        $this->assertArrayHasKey('currency', $isoAttributes);
        $this->assertIsArray($isoAttributes['currency']);

        $this->assertEquals('US', $isoAttributes['alpha2']);
    }

    public function testGetCountryIsoCode()
    {
        $country = Country::whereCode('US')->first();

        $this->assertIsString($country->isoAlpha3);
        $this->assertEquals('USA', $country->isoAlpha3);
    }

    public function testGetCountryIsoName()
    {
        $country = Country::whereCode('US')->first();

        $this->assertIsString($country->isoName);
        $this->assertEquals('United States of America', $country->isoName);
    }

    public function testGetCountryIsoNumeric()
    {
        $country = Country::whereCode('US')->first();

        $this->assertIsString($country->isoNumeric);
        $this->assertEquals('840', $country->isoNumeric);
    }

    public function testGetCountryIsoCurrencies()
    {
        $country = Country::whereCode('US')->first();
        $currencies = $country->isoCurrencies;

        $this->assertIsArray($currencies);
        $this->assertEquals('USD', $currencies[0]);
    }
}
