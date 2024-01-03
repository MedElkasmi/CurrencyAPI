<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Country;

class CountryTest extends TestCase
{
    use RefreshDatabase; // Use the RefreshDatabase trait to reset the database after each test.

    /**
     * Test basic country creation.
     *
     * @return void
     */
    public function test_country_creation() {

        // Create a new country instance and save it to the database.
        $country = new Country();
        $country->name = 'Test Country';
        $country->code = 'TC';
        $country->save();

        // Retrieve the country from the database.
        $retrievedCountry = Country::first();

        // Assert that the retrieved country is the same as the one we created.
        $this->assertEquals('Test Country', $retrievedCountry->name);
        $this->assertEquals('TC', $retrievedCountry->code);
    }
}
