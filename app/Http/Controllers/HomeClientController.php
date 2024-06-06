<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\Area;
use App\Models\Street;
use App\Models\PostalCode;
use App\Models\House;

class HomeClientController extends Controller
{
    public function index()
    {
        // Fetch data similar to the HomeController
        $topCities = DB::table('cities')
            ->join('areas', 'cities.id', '=', 'areas.city_id')
            ->join('streets', 'areas.id', '=', 'streets.area_id')
            ->groupBy('cities.id')
            ->orderByDesc(DB::raw('COUNT(streets.id)'))
            ->take(3)
            ->get(['cities.*', DB::raw('COUNT(streets.id) as streets_count')]);

        $topCitiesWithPostalCodes = [];
        foreach ($topCities as $topCity) {
            $postalCodes = DB::table('postal_codes')
                ->where('city_id', $topCity->id)
                ->pluck('code')
                ->toArray();

            $topCity->postalCodes = $postalCodes;
            $topCitiesWithPostalCodes[] = $topCity;
        }

        // Fetch houses data (replace with your actual logic to fetch houses)
        $houses = House::with(['street.area.city.postalCodes'])->get();

        // Calculate total counts
        $totalHouses = $houses->count();
        $totalCities = City::count();
        $totalAreas = Area::count();
        $totalStreets = Street::count();

        // Pass the data to the view
        return view('homeClient', compact('topCitiesWithPostalCodes', 'houses', 'totalHouses', 'totalCities', 'totalAreas', 'totalStreets'));
    }
}
