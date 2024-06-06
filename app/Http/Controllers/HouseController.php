<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Street;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Middlewares\PermissionMiddleware;



class HouseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:house-list|house-create|house-edit|house-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:house-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:house-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:house-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        
        $houses = House::all();
        return view('houses.index', compact('houses'));
    }

    public function create()
    {
        $cities = City::all();
        return view('houses.create', compact('cities'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'number' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'street_id' => 'required|exists:streets,id',
            ]);

            // Create a new House with the provided data
            House::create([
                'number' => $request->input('number'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'street_id' => $request->input('street_id'),
            ]);

            // Redirect to the index page with a success message
            return redirect()->route('houses.index')->with('success', 'تم إنشاء المنزل بنجاح.');

        } catch (QueryException $e) {
            // Log the exception or handle it as needed
            // dd($e->getMessage());
            // Redirect to the create page with an error message
            return redirect()->route('houses.create')->with('error', 'حدث خطأ أثناء إنشاء المنزل.');
        }
    }

    public function show(House $house)
    {
        return view('houses.show', compact('house'));
    }

    public function edit(House $house)
    {
        $streets = Street::all();
        return view('houses.edit', compact('house', 'streets'));
    }

    public function update(Request $request, House $house)
    {
        // Validate the request
        $request->validate([
            'number' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'street_id' => 'required|exists:streets,id',
        ]);

        try {
            // Update the House with the provided data
            $house->update([
                'number' => $request->input('number'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'street_id' => $request->input('street_id'),
            ]);

            // Redirect to the index page with a success message
            return redirect()->route('houses.index')->with('success', 'تم تحديث المنزل بنجاح.');

        } catch (\Exception $e) {
            // Redirect to the edit page with an error message
            return redirect()->route('houses.edit', $house->id)->with('error', 'حدث خطأ أثناء تحديث المنزل.')->withErrors(['number' => 'حدث خطأ أثناء تحديث المنزل.']);
        }
    }

    public function destroy(House $house)
    {
        try {
            $house->delete();
            // Redirect to the index page with a success message
            return redirect()->route('houses.index')->with('success', 'تم حذف المنزل بنجاح.');

        } catch (\Exception $e) {
            // Redirect to the index page with an error message
            return redirect()->route('houses.index')->with('error', 'حدث خطأ أثناء حذف المنزل.');
        }
    }

    public function getAreas($cityId)
    {
        $areas = Area::where('city_id', $cityId)->get();
        return response()->json($areas);
    }
    
    public function getStreets($areaId)
    {
        $streets = Street::where('area_id', $areaId)->get();
        return response()->json($streets);
    }


    
}
