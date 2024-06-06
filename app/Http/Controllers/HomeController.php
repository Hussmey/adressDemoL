<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use App\Models\City;
use App\Models\Area;
use App\Models\Street;
use App\Models\PostalCode;
use App\Models\House;
use Spatie\Permission\Middlewares\PermissionMiddleware;


use Illuminate\Http\Request;

class HomeController extends Controller
{


    
    public function index()
    {
        $citiesCount = City::count();
        $areasCount = Area::count();
        $streetsCount = Street::count();
        $postCodesCount = PostalCode::count();
        
        $houses = House::with(['street.area.city.postalCodes'])->get();

        
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

        return view('home', compact('citiesCount', 'areasCount', 'streetsCount', 'postCodesCount', 'houses', 'topCitiesWithPostalCodes'));
        }
    
    
}
