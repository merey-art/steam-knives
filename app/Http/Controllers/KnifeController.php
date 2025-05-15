<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Knife;          // ← импорт модели ножей

class KnifeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $knives = Knife::with('knives')->get();
        return view('knives.index', compact('knives'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();           // ← получаем все категории
        return view('knives.create', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        Category::create($data);
        return redirect()->route('knives.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Knife $knife)
    {
        return view('knives.show', compact('knife'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Knife $knife)
    {
        $categories = Category::all();           // ← чтобы в селекте были все категории
        return view('knives.edit', compact('knife', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Knife $knife)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        $knife->update($validated);

        return redirect()->route('knives.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Knife $knife)
    {
        $knife->delete();

        return redirect()->route('knives.index');
    }
}
