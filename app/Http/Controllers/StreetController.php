<?php

namespace App\Http\Controllers;

use App\Models\Street;
use App\Models\Area;
use Illuminate\Http\Request;
use Spatie\Permission\Middlewares\PermissionMiddleware;


class StreetController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:street-list|street-create|street-edit|street-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:street-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:street-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:street-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $streets = Street::all();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['streets' => $streets]);
        }

        return view('streets.index', compact('streets'));
    }

    public function create()
    {
        $areas = Area::all();
        return view('streets.create', compact('areas'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'area_id' => 'required|exists:areas,id',
        ]);

        try {
            // Create a new Street with the provided data
            Street::create([
                'name' => $request->input('name'),
                'area_id' => $request->input('area_id'),
            ]);

            // Redirect to the index page with success message
            return redirect()->route('streets.index')->with('success', 'تم إنشاء الشارع بنجاح.');
        } catch (\Exception $e) {
            // Handle exceptions or log them as needed
            // For example, you can log the exception message
            // Log::error($e->getMessage());

            // Redirect back to the create page with an error message
            return redirect()->route('streets.create')->with('error', 'حدث خطأ أثناء إنشاء الشارع.');
        }
    }

    public function show(Street $street)
    {
        return view('streets.show', compact('street'));
    }

    public function edit(Street $street)
    {
        $areas = Area::all();
        return view('streets.edit', compact('street', 'areas'));
    }

    public function update(Request $request, Street $street)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'area_id' => 'required|exists:areas,id',
        ]);

        try {
            // Update the Street with the provided data
            $street->update([
                'name' => $request->input('name'),
                'area_id' => $request->input('area_id'),
            ]);

            // Redirect to the index page with success message
            return redirect()->route('streets.index')->with('success', 'تم تحديث الشارع بنجاح.');
        } catch (\Exception $e) {
            // Handle exceptions or log them as needed
            // For example, you can log the exception message
            // Log::error($e->getMessage());

            // Redirect back to the edit page with an error message
            return redirect()->route('streets.edit', $street)->with('error', 'حدث خطأ أثناء تحديث الشارع.');
        }
    }

    public function destroy(Street $street)
    {
        try {
            // Delete the Street
            $street->delete();

            // Redirect to the index page with success message
            return redirect()->route('streets.index')->with('success', 'تم حذف الشارع بنجاح.');
        } catch (\Exception $e) {
            // Handle exceptions or log them as needed
            // For example, you can log the exception message
            // Log::error($e->getMessage());

            // Redirect back to the index page with an error message
            return redirect()->route('streets.index')->with('error', 'حدث خطأ أثناء حذف الشارع.');
        }
    }
}
