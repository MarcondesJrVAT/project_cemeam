<?php

namespace App\Http\Controllers\Admin\Lms;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CourseController extends Controller
{
    public readonly Course $course;
    public readonly Category $categories;
    public function __construct()
    {
        $this->course = new Course();
        $this->categories = new Category();
    }

    public function index(): View
    {
        $courses = $this->course->query()
            ->with('lessons')
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('admin.lms.courses.dashboard', compact('courses'));
    }

    public function create(): View
    {
        $categories = $this->categories->query()
            ->orderByDesc('created_at')
            ->get();
        return view('admin.lms.courses.partials.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:PUBLICADO,RASCUNHO,PENDENTE',
            'summary' => 'required|string',
            'body' => 'required|string',
            'featured' => 'required|boolean',
            'featured_menu' => 'required|boolean',
        ],[
            'image.image' => 'O campo imagem deve ser uma imagem',
            'image.mimes' => 'O campo imagem deve ser uma imagem do tipo: jpeg, png, jpg, gif, svg',
            'image.max' => 'O campo imagem deve ter no máximo 2048 kilobytes',
            'title.required' => 'O campo título é obrigatório',
            'title.string' => 'O campo título deve ser uma string',
            'title.max' => 'O campo título deve ter no máximo 255 caracteres',
            'category_id.required' => 'O campo categoria é obrigatório',
            'category_id.exists' => 'O campo categoria deve existir na tabela de categorias',
            'status.required' => 'O campo status é obrigatório',
            'status.in' => 'O campo status deve ser PUBLICADO, RASCUNHO ou PENDENTE',
            'summary.required' => 'O campo resumo é obrigatório',
            'summary.string' => 'O campo resumo deve ser um texto',
            'body.required' => 'O campo corpo é obrigatório',
            'body.string' => 'O campo corpo deve ser um texto',
            'featured.required' => 'O campo destaque é obrigatório',
            'featured.boolean' => 'O campo destaque deve ser um booleano',
            'featured_menu.required' => 'O campo destaque no menu é obrigatório',
            'featured_menu.boolean' => 'O campo destaque no menu deve ser um booleano',
        ]);

        $image = $request->hasFile('image');
        if ($image) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/lms/courses', $imageName);
            $validatedData['image'] = $imageName;
        }else{
            $validatedData['image'] = null;
        }

        $validatedData['slug'] = Str::slug($validatedData['title']);
        $validatedData['author_id'] = auth()->id();

        $this->course->create($validatedData);

        return redirect()->route('admin.lms.courses.index')->with('success', 'Curso criado com sucesso');
    }

    public function show(string $id): View
    {
        $course = $this->course
            ->with('category')
            ->findOrFail($id);
        return view('admin.lms.courses.partials.show', compact('course'));
    }

    public function edit(string $id): View
    {
        $course = $this->course->findOrFail($id);
        $categories = $this->categories->query()
            ->orderByDesc('created_at')
            ->get();
        return view('admin.lms.courses.partials.edit', compact('course', 'categories'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:PUBLICADO,RASCUNHO,PENDENTE',
            'summary' => 'required|string',
            'body' => 'required|string',
            'featured' => 'required|boolean',
            'featured_menu' => 'required|boolean',
        ],[
            'image.image' => 'O campo imagem deve ser uma imagem',
            'image.mimes' => 'O campo imagem deve ser uma imagem do tipo: jpeg, png, jpg, gif, svg',
            'image.max' => 'O campo imagem deve ter no máximo 2048 kilobytes',
            'title.required' => 'O campo título é obrigatório',
            'title.string' => 'O campo título deve ser uma string',
            'title.max' => 'O campo título deve ter no máximo 255 caracteres',
            'category_id.required' => 'O campo categoria é obrigatório',
            'category_id.exists' => 'O campo categoria deve existir na tabela de categorias',
            'status.required' => 'O campo status é obrigatório',
            'status.in' => 'O campo status deve ser PUBLICADO, RASCUNHO ou PENDENTE',
            'summary.required' => 'O campo resumo é obrigatório',
            'summary.string' => 'O campo resumo deve ser um texto',
            'body.required' => 'O campo corpo é obrigatório',
            'body.string' => 'O campo corpo deve ser um texto',
            'featured.required' => 'O campo destaque é obrigatório',
            'featured.boolean' => 'O campo destaque deve ser um booleano',
            'featured_menu.required' => 'O campo destaque no menu é obrigatório',
            'featured_menu.boolean' => 'O campo destaque no menu deve ser um booleano',
        ]);

        $course = $this->course->findOrFail($id);

        $image = $request->hasFile('image');
        if ($image) {
            if ($course->image){
                Storage::disk('public')->delete('lms/courses/' . $course->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/lms/courses', $imageName);
            $validatedData['image'] = $imageName;
        }else{
            $validatedData['image'] = $course->image;
        }

        $validatedData['slug'] = Str::slug($validatedData['title']);
        $validatedData['author_id'] = auth()->id();

        $course->update($validatedData);

        return redirect()->route('admin.lms.courses.index')->with('success', 'Curso atualizado com sucesso');
    }

    public function destroy(string $id): RedirectResponse
    {
        $course = $this->course->findOrFail($id);
        if($course->grades->count() > 0){
            return redirect()->route('admin.lms.courses.index')->with('error', 'Curso não pode ser removido, pois está vinculado a uma ou mais aulas!');
        }
        if ($course->image){
            Storage::disk('public')->delete('lms/courses/' . $course->image);
        }
        $course->delete();
        return redirect()->route('admin.lms.courses.index')->with('success', 'Curso deletado com sucesso');
    }
}
