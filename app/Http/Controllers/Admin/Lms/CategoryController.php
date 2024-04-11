<?php

namespace App\Http\Controllers\Admin\Lms;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public readonly Category $category;
    public function __construct()
    {
        $this->category = new Category();
    }

    public function index(): View
    {
        $categories = $this->category->orderByDesc('created_at')->paginate(10);
        return view('admin.lms.categories.dashboard', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.lms.categories.partials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'order' => 'required|integer',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não deve ter mais de 255 caracteres.',
            'name.unique' => 'Este nome já está em uso.',
            'order.required' => 'O campo ordem é obrigatório.',
            'order.integer' => 'O campo ordem deve ser um número inteiro.',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);
        $validatedData['author_id'] = auth()->id();

        $this->category->create($validatedData);

        return redirect()->route('admin.lms.categories.index')->with('success', 'Categoria criada com sucesso.');
    }

    public function show(string $id): View
    {
        $category = $this->category->findOrFail($id);
        return view('admin.lms.categories.partials.show', compact('category'));
    }

    public function edit(string $id): View
    {
        $category = $this->category->findOrFail($id);
        return view('admin.lms.categories.partials.edit', compact('category'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $category = $this->category->findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'order' => 'required|integer',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não deve ter mais de 255 caracteres.',
            'name.unique' => 'Este nome já está em uso.',
            'order.required' => 'O campo ordem é obrigatório.',
            'order.integer' => 'O campo ordem deve ser um número inteiro.',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $category->update($validatedData);

        return redirect()->route('admin.lms.categories.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $category = $this->category->findOrFail($id);
        if ($category->courses->count() > 0){
            return redirect()->route('admin.lms.categories.index')->with('error', 'Categoria não pode ser removida, pois está vinculado a um ou mais cursos!');
        }
        $category->delete();
        return redirect()->route('admin.lms.categories.index')->with('success', 'Categoria deletada com sucesso.');
    }
}
