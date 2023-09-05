<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories =  Category::query();
        if ($request->has('search')) {
            $categories->where('name', 'like', '%' . $request->search . '%');
        }
        return view('categories.index', ['categories' => $categories->orderBy('created_at', 'desc')->orderBy('name')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'image' => 'required|image',
                'category_id' => 'nullable'
            ]
        );
        try {
            Category::create([
                'name' => $request->name,
                'image' => $request->file('image')->store('vendor_logo'),
                'category_id'=> $request->category_id
            ]);
            return redirect()->route('category.index')->with('added', 'New category Added');
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $request->validate(
            [
                'name' => 'required',
                'image' => 'nullable|image',
                'category_id' => 'nullable'
            ]
        );
        $category->name = $request->name;
        $category->category_id = $request->category_id;
        if($category->image && $request->file('image')){
            Storage::delete($category->image);
            $category->image = Storage::put("vendor_logo",$request->file('image'));
        }elseif($request->file('image')){
            $category->image = Storage::put("vendor_logo",$request->file('image'));
        }
        $category->save();
        return redirect()->route('category.index')->with('added', 'category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        if($category->image) Storage::delete($category->image);
        $category->destroy($id);
        return back()->with('added', 'category deleted');
    }
}
