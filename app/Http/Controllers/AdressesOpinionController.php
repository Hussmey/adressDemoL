<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdressesOpinion;

class AdressesOpinionController extends Controller
{
    // عرض جميع الآراء
    public function index()
    {
        $opinions = AdressesOpinion::all();
        return view('opinions.index', compact('opinions'));
    }

    // عرض النموذج لإنشاء رأي جديد
    public function create()
    {
        return view('opinions.create');
    }

    // حفظ رأي جديد في قاعدة البيانات
    public function store(Request $request)
    {
        $request->merge(['latitude' => $request->input('latitude', 0.0)]);
        $request->merge(['longitude' => $request->input('longitude', 0.0)]);
    
        // تعيين 'active' إلى القيمة الافتراضية false إذا لم تكن موجودة في الطلب
        $request->merge(['active' => false]);
        $request->merge(['reviewed' => false]);

        AdressesOpinion::create($request->all());

        return redirect()->back()->with('تم إرسال العنوان بنجاح');
    }

    // عرض رأي معين

public function show(AdressesOpinion $opinion)
{
    // Update the 'active' status for the specific opinion
    $opinion->update(['active' => true]);

    return view('opinions.show', compact('opinion'))->with('success', 'تم تحديث الرأي بنجاح');
}

    // عرض النموذج لتحرير رأي قائم
    public function edit(AdressesOpinion $opinion)
    {
        return view('opinions.edit', compact('opinion'));
    }

    // تحديث رأي قائم في قاعدة البيانات
    public function update(Request $request, AdressesOpinion $opinion)
    {
        $opinion->update($request->all());

        return redirect()->route('opinions.index')->with('success', 'تم تحديث الرأي بنجاح');
    }

    // إلغاء تنشيط رأي (تعيين active إلى false)
    public function deactivate(AdressesOpinion $opinion)
    {
        $opinion->update(['active' => false]);

        return redirect()->route('opinions.index')->with('success', 'تم إلغاء تنشيط الرأي بنجاح');
    }

    // تنشيط رأي (تعيين active إلى true)
    public function activate(AdressesOpinion $opinion)
    {
        $opinion->update(['active' => true]);

        return redirect()->route('opinions.index')->with('success', 'تم تنشيط الرأي بنجاح');
    }

    // حذف رأي من قاعدة البيانات
    public function destroy(AdressesOpinion $opinion)
    {
        $opinion->delete();

        return redirect()->route('opinions.index')->with('success', 'تم حذف الرأي بنجاح');
    }

// AdressesOpinionController.php

public function adressClientConfirme(AdressesOpinion $opinion)
{
    // Retrieve all active opinions
    $activeOpinions = AdressesOpinion::where('active', true)->get();
    $notReviewedOpinions = AdressesOpinion::where('reviewed', false)->get();

    // Return the view for adressClientConfirme
    return view('opinions.adressClientConfirme', compact('activeOpinions'));
}
public function updateReviewStatus(AdressesOpinion $opinion)
{
    // Update the 'reviewed' status for the specific opinion
    $opinion->update(['reviewed' => true]);

    // Redirect back to the show view with the success message
    return redirect()->route('opinions.index')->with('success', 'تم تحديث الرأي بنجاح');
}

}
