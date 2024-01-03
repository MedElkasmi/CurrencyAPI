<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        //
    }

    public function getCurrencyData(Request $request, $countryCode) {

        // Find the country by its code
        $country = Country::where('code',$countryCode)->first();

        if(!$country) {
            return response()->json(['message' => 'Country Not Found.'],404);
        }

        $currency = $country->currencies()->first();

        if(!$currency) {
            return response()->json(['message' => 'Currency Nout Found for this country.'],404);
        }

        // Get the current price
        $currentPrice = $currency->prices()->latest('price_date')->first();

        // Get the prices for the last six months
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $pricesLastSixMonths = $currency->prices()
            ->where('price_date', '>=', $sixMonthsAgo)
            ->orderBy('price_date', 'asc')
            ->get();

        // Calculate performance
        $performance = $this->calculatePerformance($pricesLastSixMonths);

        return response()->json([
            'currency' => $currency->name,
            'current_price' => $currentPrice ? $currentPrice->price : null,
            'performance_last_six_months' => $performance
        ]);

    }

    public function calculatePerformance($prices) {

        if ($prices->isEmpty()) {
            return [
                'average_price' => null,
                'percentage_change' => null
            ];
        }

        // Calculate Average Price
        $totalPrice = $prices->sum('price');
        $averagePrice = $totalPrice / $prices->count();

        // Calculate Percentage Change
        $oldestPrice = $prices->first()->price;
        $latestPrice = $prices->last()->price;
        $percentageChange = (($latestPrice - $oldestPrice) / $oldestPrice) * 100;

        return [
            'average_price' => $averagePrice,
            'percentage_change' => $percentageChange
        ];
    }

}
