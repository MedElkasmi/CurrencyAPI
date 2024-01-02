<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currencies = ['Dollar', 'Euro', 'Yen', 'Pound', 'Franc']; // Add more as needed
        return [
            'country_id' => Country::factory(),
            'name' => $this->faker->randomElement($currencies),
            'code' => $this->faker->unique()->currencyCode
        ];
    }
}
