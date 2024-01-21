<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function update(Request $request, AppSetting $appSetting)
    {
        $data = $request->validate([
            'usd_rate' => ['required', 'numeric']
        ]);

        $appSetting->update($data);

        return response()->json($appSetting);
    }

    public function find(Request $request, AppSetting $appSetting)
    {
        return response()->json($appSetting);
    }
}
