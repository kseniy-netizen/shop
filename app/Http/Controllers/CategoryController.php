<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Inertia\Inertia;
use Inertia\Response;
class CategoryController extends Controller
{
public function index(): Response
{
$categories = Category::orderBy('id', 'desc')->get();
return Inertia::render('Categories/Index', [
'categories' => $categories,
]);
}
public function create(): Response
{
return Inertia::render('Categories/Create');
}
public function store(CategoryRequest $request)
{
Category::create($request->validated());
return redirect()
->route('categories.index')
->with('success', 'Категория успешно создана.');
}
public function edit(Category $category): Response
{
return Inertia::render('Categories/Edit', [
'category' => $category,
]);
}

public function update(CategoryRequest $request, Category $category)
{
$category->update($request->validated());
return redirect()
->route('categories.index')
->with('success', 'Категория обновлена.');
}
public function destroy(Category $category)
{
$category->delete();
return redirect()
->route('categories.index')
->with('success', 'Категория удалена.');
}


}