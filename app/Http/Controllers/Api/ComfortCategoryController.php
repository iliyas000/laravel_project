<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComfortCategory;
use Illuminate\Http\Request;

class ComfortCategoryController extends Controller
{
    public function index()
    {
        return ComfortCategory::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string']);
        return ComfortCategory::create($data);
    }

    public function show(ComfortCategory $comfortCategory)
    {
        return $comfortCategory;
    }

    public function update(Request $request, ComfortCategory $comfortCategory)
    {
        $data = $request->validate(['name' => 'required|string']);
        $comfortCategory->update($data);
        return $comfortCategory;
    }

    public function destroy(ComfortCategory $comfortCategory)
    {
        $comfortCategory->delete();
        return response()->noContent();
    }
}
