<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Storage;

class PictureController extends Controller
{
    public function destroy(Request $request, Picture $picture)
    {
        if (Storage::exists($picture->getRawOriginal('name'))) Storage::delete($picture->getRawOriginal('name'));

        $picture->delete();
        return response()->json();
    }

    public function update(Request $request, Picture $picture)
    {
        $data = $request->validate([
            'sort' => ['required', 'numeric']
        ]);

        $picture->update($data);

        return response()->json($picture);
    }
}
