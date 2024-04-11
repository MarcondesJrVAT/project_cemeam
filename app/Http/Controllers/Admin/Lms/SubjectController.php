<?php

namespace App\Http\Controllers\Admin\Lms;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubjectController extends Controller
{
    public readonly Subject $subject;
    public function __construct()
    {
        $this->subject = new Subject();
    }

    public function index(): View
    {
        $subjects = $this->subject->query()
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('admin.lms.subjects.dashboard', compact('subjects'));
    }

    public function create(): View
    {
        return view('admin.lms.subjects.partials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:subjects,title',
            'code' => 'required|string|max:255|unique:subjects,code',
            'status' => 'required|in:PUBLICADO,RASCUNHO,PENDENTE',
            'description' => 'nullable|string|max:255',
        ],[
            'title.required' => 'O campo título é obrigatório',
            'title.unique' => 'O título informado já está em uso',
            'code.required' => 'O campo código é obrigatório',
            'code.unique' => 'O código informado já está em uso',
            'status.required' => 'O campo status é obrigatório',
            'status.in' => 'O status informado é inválido',
        ]);

        $validatedData['author_id'] = auth()->id();

        $this->subject->create($validatedData);

        return redirect()->route('admin.lms.subjects.index')->with('success', 'Componente Curricular criado com sucesso!');
    }

    public function show(string $id): View
    {
        $subject = $this->subject->query()->findOrFail($id);
        return view('admin.lms.subjects.partials.show', compact('subject'));
    }

    public function edit(string $id): View
    {
        $subject = $this->subject->query()->findOrFail($id);
        return view('admin.lms.subjects.partials.edit', compact('subject'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $subject = $this->subject->query()->findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:subjects,title,'.$id,
            'code' => 'required|string|max:255|unique:subjects,code,'.$id,
            'status' => 'required|in:PUBLICADO,RASCUNHO,PENDENTE',
            'description' => 'nullable|string|max:255',
        ],[
            'title.required' => 'O campo título é obrigatório',
            'title.unique' => 'O título informado já está em uso',
            'code.required' => 'O campo código é obrigatório',
            'code.unique' => 'O código informado já está em uso',
            'status.required' => 'O campo status é obrigatório',
            'status.in' => 'O status informado é inválido',
        ]);

        $validatedData['author_id'] = auth()->id();

        $subject->update($validatedData);

        return redirect()->route('admin.lms.subjects.index')->with('success', 'Componente Curricular atualizado com sucesso!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $subject = $this->subject->query()->findOrFail($id);
        if ($subject->grades()->exists()) {
            return redirect()->route('admin.lms.subjects.index')->with('error', 'Componente não pode ser removido, pois está vinculado a um ou mais séries!');
        }
        $subject->delete();
        return redirect()->route('admin.lms.subjects.index')->with('success', 'Componente removido com sucesso!');
    }
}
