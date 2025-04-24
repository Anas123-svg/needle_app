<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortfolioImageCategory;

class PortfolioImageCategoryController extends Controller
{
    public function index()
    {
        return PortfolioImageCategory::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $category = PortfolioImageCategory::create([
            'user_id' => auth()->id(), 
            'name' => $validated['name'],
        ]);
    
        return response()->json($category, 201);
    }
    
    public function show($id)
    {
        $category = PortfolioImageCategory::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
        ]);

        $category = PortfolioImageCategory::findOrFail($id);
        $category->update($validated);
        return response()->json($category);
    }
    public function userCategories()
{
    $categories = PortfolioImageCategory::where('user_id', auth()->id())->get();

    return response()->json($categories);
}

    public function destroy($id)
    {
        $category = PortfolioImageCategory::findOrFail($id);
        $category->delete();
        return response()->json(null, 204);
    }

}
