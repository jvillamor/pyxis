<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.index', ['settings' => SiteSetting::orderBy('group')->orderBy('label')->get()]);
    }

    public function update(Request $request, SiteSetting $setting): RedirectResponse
    {
        $validated = $request->validate(['value' => ['nullable', 'string', 'max:2000']]);
        $setting->update(['value' => $validated['value'] ?? null, 'updated_by' => $request->user()->id]);

        return back()->with('status', $setting->label.' was updated.');
    }
}
