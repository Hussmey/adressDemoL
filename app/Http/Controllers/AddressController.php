<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Spatie\Permission\Middlewares\PermissionMiddleware;


class AddressController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:addresses-view', ['only' => ['index']]);
    }
    
    public function index(Request $request)
    {
        $houses = House::with(['street.area.city.postalCodes'])->get();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['houses' => $houses]);
        }
        return view('addresses.index', compact('houses'));
    }
    
}
