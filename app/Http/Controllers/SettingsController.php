<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Settings $settings)
    {
        $row = Settings::all();
        foreach ($row as $rows) {
            $settings[$rows['settings_key']] = $rows['settings_value'];
        }
        return view('dashboard.settings.index', compact('settings'));
    }

    public function update(Request $request, Settings $settings)
    {

        $data = $request->data;

        foreach ($data as $key => $value) {
            $key = trim($key);
            $value = trim($value);

            $settings->where('settings_key', $key)->update([
                'settings_value' => $value
            ]);
        }

        if ($request->has('logo')) {
            $fileOriginalExtensions = $request->file('logo')->getClientOriginalExtension();
            $logo = time() . '.' . $fileOriginalExtensions;
            $request->logo->storeAs('image', $logo, 'public');
            $settings->where('settings_key', 'logo')->update([
                'settings_value' => $logo
            ]);
        }

        if ($request->has('favicon')) {
            $fileOriginalExtension = $request->file('favicon')->getClientOriginalExtension();
            $favicon = time() . '.' . $fileOriginalExtension;
            $request->favicon->storeAs('image', $favicon, 'public');
            $settings->where('settings_key', 'favicon')->update([
                'settings_value' => $favicon
            ]);
        }

        return redirect()->back()->with('message', 'Settings Updated');

    }


}
