<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Area; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:city-list|city-create|city-edit|city-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:city-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:city-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:city-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $cities = City::all();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['cities' => $cities]);
        }
        return view('cities.index', compact('cities'));
    }

    public function create()
    {
        return view('cities.create');
    }

    public function store(Request $request)
    {
        City::create($request->all());
        return redirect()->route('cities.index')->with('success', 'تم إنشاء المدينة بنجاح.');

    }

    public function show(City $city)
    {
        $city->load('areas.postCodeArea');
   
        return view('cities.show', compact('city'));
    }
    

    public function edit(City $city)
    {
        return view('cities.edit', compact('city'));
    }
    
    public function update(Request $request, City $city)
    {
        $city->update($request->all());
        return redirect()->route('cities.index')->with('success', 'تم تحديث المدينة بنجاح.');
    }
    

    public function destroy(City $city)
    {
        $city->delete();
    return redirect()->route('cities.index')->with('success', 'تم حذف المدينة بنجاح.');
    }


    protected function sendFailedResponse($message)
{
    return redirect()->back()->with('error', $message)->withInput();
}
}
