<?php

namespace Winter\Location\Tests\Unit;

use Winter\Location\Models\Country;
use Winter\Location\Models\State;
use Winter\Location\Tests\BaseTestCase;

class LocationModelsTest extends BaseTestCase
{
    public function testGetCountry()
    {
        $country = Country::whereCode('US')->first();
        $this->assertEquals('United States', $country->name);
    }

    public function testCreateCountry()
    {
        $country = Country::create([
            'name' => 'Winter land',
            'code' => 'WL',
        ]);
        $country->is_pinned = true;
        $country->is_enabled = false;
        $country->save();

        $this->assertEquals('WL', $country->code);
        $this->assertTrue($country->is_pinned);
        $this->assertFalse($country->is_enabled);
    }

    public function testGetCountryStatesRelation()
    {
        $country = Country::whereCode('US')->first();
        $states = $country->states;
        $firstState = $states->first();

        $this->assertInstanceOf(\Winter\Storm\Database\Collection::class, $country->states);

        $this->assertEquals($country->id, $firstState->country_id);
        $this->assertEquals('Alabama', $firstState->name);
        $this->assertEquals('AL', $firstState->code);
    }

    public function testCreateCountryStatesRelation()
    {
        $country = Country::create([
            'name' => 'Winter Land',
            'code' => 'WL',
        ]);
        $country->states()->add(new State([
            'name' => 'Snow state',
            'code' => 'SN',
        ]));
        $newState = $country->states->first();

        $this->assertEquals('SN', $newState->code);
        $this->assertEquals(1, $country->states->count());
    }
}
