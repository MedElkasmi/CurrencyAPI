<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Country;
use App\Models\Currency;
use App\Models\CurrencyPrice;
use Carbon\Carbon;
use Tests\TestCase;

class CurrencyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_currency_data_with_valid_country_code() {

        $country = Country::factory()->create(['code' => 'US']);
        $currency = Currency::factory()->create(['country_id' => $country->id]);
        CurrencyPrice::factory()->create([
            'currency_id' => $currency->id,
            'price' => 100,
            'price_date' => Carbon::now()
        ]);

        $response = $this->getJson("/api/currency-data/{$country->code}");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'currency',
                     'current_price',
                     'performance_last_six_months' => [
                         'average_price',
                         'percentage_change'
                     ]
                 ]);
    }

    public function test_get_currency_data_with_invalid_country_code() {

        $response = $this->getJson("/api/currency-data/invalid-code");
        $response->assertStatus(404);
    }

    public function test_calculate_performance() {

        $currency = Currency::factory()->create();
        $prices = collect();

        // Create price records - simulate the change over six months
        for ($month = 6; $month >= 0; $month--) {
            $date = Carbon::now()->subMonths($month);
            $price = CurrencyPrice::factory()->create([
                'currency_id' => $currency->id,
                'price' => 100 + $month * 10, // Example: Increasing price
                'price_date' => $date
            ]);
            $prices->push($price);
        }

        // Create an instance of CurrencyController and call calculatePerformance
        $controller = new \App\Http\Controllers\CurrencyController();
        $response = $controller->calculatePerformance($prices);

        // Define expected values
        $expectedAverage = $prices->avg('price');
        $expectedChange = (($prices->last()->price - $prices->first()->price) / $prices->first()->price) * 100;

        // Assert the results
        $this->assertEquals($expectedAverage, $response['average_price']);
        $this->assertEquals($expectedChange, $response['percentage_change']);
    }

}
