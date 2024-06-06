<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\PostCodeArea;
use Illuminate\Http\Request;
use Spatie\Permission\Middlewares\PermissionMiddleware;


class PostCodeAreaController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:postcodearea-list|postcodearea-create|postcodearea-edit|postcodearea-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:postcodearea-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:postcodearea-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:postcodearea-delete', ['only' => ['destroy']]);
    }

    
    public function index()
    {
        // Eager load the 'area' relationship
        $postCodeAreas = PostCodeArea::with('area')->get();
        return view('postCodeAreas.index', compact('postCodeAreas'));
    }
    

    public function create()
    {
        return view('postCodeAreas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        PostCodeArea::create([
            'code' => $request->input('code'),
        ]);

        return redirect()->route('postCodeAreas.index')->with('success', 'تم إنشاء الرمز البريدي بنجاح.');
    }

    public function show(PostCodeArea $postCodeArea)
    {
        return view('postCodeAreas.show', compact('postCodeArea'));
    }

    public function edit(PostCodeArea $postCodeArea)
    {
        return view('postCodeAreas.edit', compact('postCodeArea'));
    }

    public function update(Request $request, PostCodeArea $postCodeArea)
    {
     
        $request->validate([
            'code' => 'required',
        ]);
       
        $postCodeArea->update([
            'code' => $request->input('code'),
        ]);

        return redirect()->route('postCodeAreas.index')->with('success', 'تم تحديث الرمز البريدي بنجاح.');
    }

    public function destroy(PostCodeArea $postCodeArea)
    {
        $postCodeArea->delete();
        return redirect()->route('postCodeAreas.index')->with('success', 'تم حذف الرمز البريدي بنجاح.');
    }
}
