<?php

namespace App\Http\Controllers\Admin\Lms;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GradeController extends Controller
{
    public readonly Grade $grade;
    public readonly Course $course;
    public readonly Subject $subject;
    public function __construct()
    {
        $this->grade = new Grade();
        $this->course = new Course();
        $this->subject = new Subject();
    }

    public function index(): View
    {
        $grades = $this->grade->query()
            ->with('course')
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('admin.lms.grades.dashboard', compact('grades'));
    }

    public function create(): View
    {
        $courses = $this->course->all();
        $subjects = $this->subject->all();
        return view('admin.lms.grades.partials.create', compact('courses', 'subjects'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:grades,title',
            'course_id' => 'required|exists:courses,id',
            'subjects' => 'required|array',
            'subjects.*' => 'required|exists:subjects,id',
            'status' => 'required|in:PUBLICADO,RASCUNHO,PENDENTE',
            'description' => 'required|string'
        ],[
            'title.required' => 'O campo título é obrigatório',
            'title.unique' => 'Já existe uma série com este título',
            'course_id.required' => 'O campo curso é obrigatório',
            'course_id.exists' => 'O curso informado não existe',
            'subjects.required' => 'O campo disciplinas é obrigatório',
            'subjects.*.required' => 'O campo disciplinas é obrigatório',
            'subjects.*.exists' => 'A disciplina informada não existe',
            'status.required' => 'O campo status é obrigatório',
            'status.in' => 'O status informado é inválido',
            'description.required' => 'O campo descrição é obrigatório'
        ]);

        $validatedData['author_id'] = auth()->id();
        $grade = $this->grade->create($validatedData);

        $grade->subjects()->sync($validatedData['subjects']);

        return redirect()->route('admin.lms.grades.index')->with('success', 'Série criada com sucesso');
    }

    public function show(string $id): View
    {
        $grade = $this->grade->query()
            ->with('course', 'subjects')
            ->findOrFail($id);
        return view('admin.lms.grades.partials.show', compact('grade'));
    }

    public function edit(string $id): View
    {
        $grade = $this->grade->query()
            ->with('course', 'subjects')
            ->findOrFail($id);
        $courses = $this->course->all();
        $subjects = $this->subject->all();
        return view('admin.lms.grades.partials.edit', compact('grade', 'courses', 'subjects'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:grades,title,' . $id,
            'course_id' => 'required|exists:courses,id',
            'subjects' => 'required|array',
            'subjects.*' => 'required|exists:subjects,id',
            'status' => 'required|in:PUBLICADO,RASCUNHO,PENDENTE',
            'description' => 'required|string'
        ],[
            'title.required' => 'O campo título é obrigatório',
            'title.unique' => 'Já existe uma série com este título',
            'course_id.required' => 'O campo curso é obrigatório',
            'course_id.exists' => 'O curso informado não existe',
            'subjects.required' => 'O campo disciplinas é obrigatório',
            'subjects.*.required' => 'O campo disciplinas é obrigatório',
            'subjects.*.exists' => 'A disciplina informada não existe',
            'status.required' => 'O campo status é obrigatório',
            'status.in' => 'O status informado é inválido',
            'description.required' => 'O campo descrição é obrigatório'
        ]);

        $grade = $this->grade->findOrFail($id);

        $grade->update($validatedData);

        $grade->subjects()->sync($validatedData['subjects']);

        return redirect()->route('admin.lms.grades.index')->with('success', 'Série atualizada com sucesso');
    }

    public function destroy(string $id): RedirectResponse
    {
        $grade = $this->grade->findOrFail($id);
        if ($grade->lessons()->count() > 0) {
            return redirect()->route('admin.lms.grades.index')->with('error', 'Série não pode ser removido, pois está vinculado a um ou mais aulas!');
        }
        $grade->delete();
        return redirect()->route('admin.lms.grades.index')->with('success', 'Série excluída com sucesso');
    }
}
