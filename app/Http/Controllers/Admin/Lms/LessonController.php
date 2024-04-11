<?php

namespace App\Http\Controllers\Admin\Lms;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LessonController extends Controller
{
    public readonly Lesson $lesson;
    public readonly Grade $grade;
    public readonly Year $year;
    public readonly User $user;
    public function __construct()
    {
        $this->lesson = new Lesson();
        $this->grade = new Grade();
        $this->year = new Year();
        $this->user = new User();
    }

    public function index(): View
    {
        $lessons = $this->lesson->query()
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('admin.lms.lessons.dashboard', compact('lessons'));
    }

    public function create(): View
    {
        $grades = $this->grade->query()->with(['course', 'subjects'])->orderByDesc('created_at')->get();
        $years = $this->year->query()->orderByDesc('year')->get();
        $users = $this->user->query()->orderByDesc('name')->get();
        return view('admin.lms.lessons.partials.create', compact('grades', 'years', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:lessons,code',
            'year_id' => 'required|integer',
            'lesson_date' => 'required|date',
            'status' => 'required|in:PUBLICADO,RASCUNHO,PENDENTE,CANCELADO',
            'grade_id' => 'required|integer',
            'teachers_id' => 'required|array',
            'teachers_id.*' => 'required|integer|exists:users,id',
            'description' => 'required|string',
            'tags' => 'required|string',
        ],[
            'image.image' => 'O campo imagem deve ser uma imagem.',
            'image.mimes' => 'O campo imagem deve ser uma imagem do tipo: jpeg, png, jpg, gif, svg.',
            'image.max' => 'O campo imagem deve ter no máximo 2048 kilobytes.',
            'title.required' => 'O campo título é obrigatório.',
            'title.string' => 'O campo título deve ser uma string.',
            'title.max' => 'O campo título deve ter no máximo 255 caracteres.',
            'slug.required' => 'O campo slug é obrigatório.',
            'slug.string' => 'O campo slug deve ser uma string.',
            'slug.max' => 'O campo slug deve ter no máximo 255 caracteres.',
            'slug.unique' => 'O campo slug já está em uso.',
            'code.required' => 'O campo código é obrigatório.',
            'code.string' => 'O campo código deve ser uma string.',
            'code.max' => 'O campo código deve ter no máximo 255 caracteres.',
            'code.unique' => 'O campo código já está em uso.',
            'year.required' => 'O campo ano é obrigatório.',
            'year.integer' => 'O campo ano deve ser um inteiro.',
            'lesson_date.required' => 'O campo data da aula é obrigatório.',
            'lesson_date.date' => 'O campo data da aula deve ser uma data.',
            'status.required' => 'O campo status é obrigatório.',
            'status.in' => 'O campo status deve ser PUBLICADO, RASCUNHO, PENDENTE ou CANCELADO.',
            'grade_id.required' => 'O campo curso é obrigatório.',
            'grade_id.integer' => 'O campo curso deve ser um inteiro.',
            'teachers_id.required' => 'O campo professores é obrigatório.',
            'teachers_id.array' => 'O campo professores deve ser um array.',
            'teachers_id.*.required' => 'O campo professores deve ser um array de inteiros.',
            'teachers_id.*.integer' => 'O campo professores deve ser um array de inteiros.',
            'teachers_id.*.exists' => 'O campo professores deve ser um array de inteiros existentes.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.string' => 'O campo descrição deve ser uma string.',
            'tags.required' => 'O campo tags é obrigatório.',
            'tags.string' => 'O campo tags deve ser uma string.',
        ]);

        $image = $request->hasFile('image');
        if ($image) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/lms/lessons', $imageName);
            $validatedData['image'] = $imageName;
        }else{
            $validatedData['image'] = null;
        }

        $validatedData['slug'] = Str::slug($validatedData['title']);
        $validatedData['author_id'] = auth()->id();

        $lesson = $this->lesson->create([
            'image' => $validatedData['image'],
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'code' => $validatedData['code'],
            'year_id' => $validatedData['year_id'],
            'lesson_date' => $validatedData['lesson_date'],
            'status' => $validatedData['status'],
            'grade_id' => $validatedData['grade_id'],
            'author_id' => $validatedData['author_id'],
            'description' => $validatedData['description'],
            'tags' => $validatedData['tags'],
        ]);

        $lesson->teachers()->attach($validatedData['teachers_id']);

        return redirect()->route('admin.lms.lessons.index')->with('success', 'Aula criada com sucesso.');

    }

    public function show(string $id): View
    {
        $lesson = $this->lesson->query()->findOrFail($id);
        return view('admin.lms.lessons.partials.show', compact('lesson'));
    }

    public function edit(string $id): View
    {
        $lesson = $this->lesson->findOrFail($id);
        $grades = $this->grade->query()->with(['course', 'subjects'])->orderByDesc('created_at')->get();
        $years = $this->year->query()->orderByDesc('year')->get();
        $users = $this->user->query()->orderByDesc('name')->get();
        return view('admin.lms.lessons.partials.edit', compact('lesson', 'grades', 'years', 'users'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $lesson = $this->lesson->findOrFail($id);

        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:lessons,code,'.$lesson->id,
            'year_id' => 'required|integer',
            'lesson_date' => 'required|date',
            'status' => 'required|in:PUBLICADO,RASCUNHO,PENDENTE,CANCELADO',
            'grade_id' => 'required|integer',
            'teachers_id' => 'required|array',
            'teachers_id.*' => 'required|integer|exists:users,id',
            'description' => 'required|string',
            'tags' => 'required|string',
        ],[
            'image.image' => 'O campo imagem deve ser uma imagem.',
            'image.mimes' => 'O campo imagem deve ser uma imagem do tipo: jpeg, png, jpg, gif, svg.',
            'image.max' => 'O campo imagem deve ter no máximo 2048 kilobytes.',
            'title.required' => 'O campo título é obrigatório.',
            'title.string' => 'O campo título deve ser uma string.',
            'title.max' => 'O campo título deve ter no máximo 255 caracteres.',
            'slug.required' => 'O campo slug é obrigatório.',
            'slug.string' => 'O campo slug deve ser uma string.',
            'slug.max' => 'O campo slug deve ter no máximo 255 caracteres.',
            'slug.unique' => 'O campo slug já está em uso.',
            'code.required' => 'O campo código é obrigatório.',
            'code.string' => 'O campo código deve ser uma string.',
            'code.max' => 'O campo código deve ter no máximo 255 caracteres.',
            'code.unique' => 'O campo código já está em uso.',
            'year.required' => 'O campo ano é obrigatório.',
            'year.integer' => 'O campo ano deve ser um inteiro.',
            'lesson_date.required' => 'O campo data da aula é obrigatório.',
            'lesson_date.date' => 'O campo data da aula deve ser uma data.',
            'status.required' => 'O campo status é obrigatório.',
            'status.in' => 'O campo status deve ser PUBLICADO, RASCUNHO, PENDENTE ou CANCELADO.',
            'grade_id.required' => 'O campo curso é obrigatório.',
            'grade_id.integer' => 'O campo curso deve ser um inteiro.',
            'teachers_id.required' => 'O campo professores é obrigatório.',
            'teachers_id.array' => 'O campo professores deve ser um array.',
            'teachers_id.*.required' => 'O campo professores deve ser um array de inteiros.',
            'teachers_id.*.integer' => 'O campo professores deve ser um array de inteiros.',
            'teachers_id.*.exists' => 'O campo professores deve ser um array de inteiros existentes.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.string' => 'O campo descrição deve ser uma string.',
            'tags.required' => 'O campo tags é obrigatório.',
            'tags.string' => 'O campo tags deve ser uma string.',
        ]);

        $image = $request->hasFile('image');
        if ($image) {
            if ($lesson->image){
                Storage::disk('public')->delete('lms/lessons/' . $lesson->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/lms/lessons', $imageName);
            $validatedData['image'] = $imageName;
        }else{
            $validatedData['image'] = $lesson->image;
        }

        $validatedData['slug'] = Str::slug($validatedData['title']);

        $lesson->update([
            'image' => $validatedData['image'],
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'code' => $validatedData['code'],
            'year_id' => $validatedData['year_id'],
            'lesson_date' => $validatedData['lesson_date'],
            'status' => $validatedData['status'],
            'grade_id' => $validatedData['grade_id'],
            'description' => $validatedData['description'],
            'tags' => $validatedData['tags'],
        ]);

        $lesson->teachers()->sync($validatedData['teachers_id']);

        return redirect()->route('admin.lms.lessons.index')->with('success', 'Aula atualizada com sucesso.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $lesson = $this->lesson->findOrFail($id);
        $lesson->delete();
        return redirect()->route('admin.lms.lessons.index')->with('success', 'Aula deletada com sucesso.');
    }
}
