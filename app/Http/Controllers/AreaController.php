<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\PostCodeArea;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Spatie\Permission\Middlewares\PermissionMiddleware;



class AreaController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:area-list|area-create|area-edit|area-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:area-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:area-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:area-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $areas = Area::all();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['areas' => $areas]);
        }

        return view('areas.index', compact('areas'));
    }

    public function create()
    {
        $cities = City::all();
        $postCodeAreas = PostCodeArea::all(); // Fetch the available PostCodeAreas
        return view('areas.create', compact('cities', 'postCodeAreas'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required',
                'city_id' => 'required|exists:cities,id',
                'post_code_area_id' => 'required|exists:post_code_areas,id',
            ]);
    
            // Check if the selected post code area is already associated with an area
            if (Area::where('post_code_area_id', $request->input('post_code_area_id'))->exists()) {
                return redirect()->route('areas.create')->with('error', 'هذه المنطقة لديها بالفعل رمز بريدي.');
            }
    
            // Create a new Area with the provided data
            Area::create([
                'name' => $request->input('name'),
                'city_id' => $request->input('city_id'),
                'post_code_area_id' => $request->input('post_code_area_id'),
            ]);
    
            // Redirect to the index page
            return redirect()->route('areas.index')->with('success', 'تم إنشاء المنطقة بنجاح.');
        } catch (QueryException $e) {
            // Log the exception or handle it as needed
           // dd($e->getMessage());
        }
    }
    

    public function show(Area $area)
    {
        // Load the 'area' relationship which corresponds to the 'PostCodeArea' model
        $area->load('postCodeArea');
    
        return view('areas.show', compact('area'));
    }
    

    public function edit(Area $area)
    {
        $cities = City::all();
        $postCodeAreas = PostCodeArea::all(); // Fetch the available PostCodeAreas
        return view('areas.edit', compact('area', 'cities', 'postCodeAreas'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'name' => 'required',
            'city_id' => 'required|exists:cities,id',
            'post_code_area_id' => 'required|exists:post_code_areas,id|unique:areas,post_code_area_id,' . $area->id,
        ], [
            'post_code_area_id.unique' => 'هذه المنطقة لديها بالفعل رمز بريدي.',
        ]);
    
        try {
            $area->update([
                'name' => $request->input('name'),
                'city_id' => $request->input('city_id'),
                'post_code_area_id' => $request->input('post_code_area_id'),
            ]);
    
            return redirect()->route('areas.index')->with('success', 'تم تحديث المنطقة بنجاح.');
        } catch (\Exception $e) {
            return redirect()->route('areas.edit', $area->id)->with('error', 'هذه المنطقة لديها بالفعل رمز بريدي.')->withErrors(['post_code_area_id' => 'هذه المنطقة لديها بالفعل رمز بريدي.']);
        }
    }
    
    

    public function destroy(Area $area)
    {
        try {
            $area->delete();
            return redirect()->route('areas.index')->with('success', 'تم حذف المنطقة بنجاح.');
        } catch (\Exception $e) {
            return redirect()->route('areas.index')->with('error', 'حدث خطأ أثناء حذف المنطقة.');
        }
    }
}
