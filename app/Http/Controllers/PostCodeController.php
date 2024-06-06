<?php

namespace App\Http\Controllers;

use App\Models\PostalCode;
use App\Models\City;
use Illuminate\Http\Request;
use Spatie\Permission\Middlewares\PermissionMiddleware;


class PostCodeController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:postcode-list|postcode-create|postcode-edit|postcode-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:postcode-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:postcode-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:postcode-delete', ['only' => ['destroy']]);
    }
 
    public function index(Request $request)
    {
        $postCodes = PostalCode::all();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['postCodes' => $postCodes]);
        }
        return view('postCodes.index', compact('postCodes'));
    }

    public function create()
    {
        $cities = City::all();
        return view('postCodes.create', compact('cities'));
    }


public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'code' => 'required',
        'city_id' => 'required|exists:cities,id',
    ]);

    // Check if the city already has a postal code
    if (PostalCode::where('city_id', $request->input('city_id'))->exists()) {
        return redirect()->route('postCodes.create')->with('error', 'هذه المدينة لديها بالفعل رمز بريدي.');
    }

    // Create a new PostalCode with the provided data
    PostalCode::create([
        'code' => $request->input('code'),
        'city_id' => $request->input('city_id'),
    ]);

    // Redirect to the index page
    return redirect()->route('postCodes.index')->with('success', 'تم إنشاء الرمز البريدي بنجاح.');
}


    public function show(PostalCode $postCode)
    {
        return view('postCodes.show', compact('postCode'));
    }

    public function edit(PostalCode $postCode)
    {
        $cities = City::all();
        return view('postCodes.edit', compact('postCode', 'cities'));
    }

    public function update(Request $request, PostalCode $postCode)
    {
        $request->validate([
            'code' => 'required', // Assuming 'code' is the field for post code
            'city_id' => 'required|exists:cities,id',
        ]);
    
        // Check if the selected post code is already associated with another city
        $existingPostCode = PostalCode::where('code', $request->input('code'))
                            ->where('city_id', '!=', $request->input('city_id'))
                            ->first();
    
        if ($existingPostCode) {
            return redirect()->route('postCodes.edit', $postCode)
                ->with('error', 'هذا الرمز البريدي مرتبط بمدينة أخرى بالفعل.');
        }
    
        try {
            // Update the post code with the provided data
            $postCode->update([
                'code' => $request->input('code'),
                'city_id' => $request->input('city_id'),
            ]);
    
            // If the update is successful, redirect to the index page with success message
            return redirect()->route('postCodes.index')->with('success', 'تم تحديث الرمز البريدي بنجاح.');
        } catch (\Exception $e) {
            // Handle exceptions as needed
            // ...
    
            // Redirect back to the edit page with a generic error message
            return redirect()->route('postCodes.edit', $postCode)->with('error', 'حدث خطأ أثناء تحديث الرمز البريدي.');
        }
    }
    

    public function destroy(PostalCode $postCode)
    {
        $postCode->delete();
        return redirect()->route('postCodes.index')->with('success', 'تم حذف الرمز البريدي بنجاح.');
    }


}
