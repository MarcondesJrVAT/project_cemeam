<?php

namespace App\Http\Controllers\Admin\Lms;

use App\Http\Controllers\Controller;
use App\Models\Year;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class YearController extends Controller
{
    public readonly Year $year;
    public function __construct()
    {
        $this->year = new Year();
    }

    public function index(): View
    {
        $years = $this->year->query()->orderByDesc('created_at')->paginate(10);
        return view('admin.lms.years.dashboard', compact('years'));
    }

    public function create(): View
    {
        $existingYears = $this->year->query()->pluck('year')->toArray();
        $allYears = range(2005, date('Y'));
        $availableYears = array_diff($allYears, $existingYears);
        return view('admin.lms.years.partials.create', compact('availableYears'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'year' => 'required|integer|between:2005,' . date('Y'),
            'current_year' => 'required|boolean',
        ], [
            'year.required' => 'O campo ano é obrigatório.',
            'year.integer' => 'O campo ano deve ser um número inteiro.',
            'year.between' => 'O campo ano deve estar entre 2005 e ' . date('Y') . '.',
            'current_year.required' => 'O campo ano corrente é obrigatório.',
            'current_year.boolean' => 'O campo ano corrente deve ser um valor booleano.',
        ]);

        $validatedData['author_id'] = auth()->id();

        $this->year->create($validatedData);

        return redirect()->route('admin.lms.years.index')->with('success', 'Ano Letivo cadastrado com sucesso.');
    }

    public function show(string $id): View
    {
        $year = $this->year->query()->findOrFail($id);
        return view('admin.lms.years.partials.show', compact('year'));
    }

    public function edit(string $id): View
    {
        $year = $this->year->query()->findOrFail($id);

        $existingYears = $this->year->query()->pluck('year')->toArray();

        $existingYears = array_diff($existingYears, [$year->year]);

        $allYears = range(2005, date('Y'));

        $availableYears = array_diff($allYears, $existingYears);

        return view('admin.lms.years.partials.edit', compact('year', 'availableYears'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $year = $this->year->query()->findOrFail($id);

        $validatedData = $request->validate([
            'year' => 'required|integer|between:2005,' . date('Y'),
            'current_year' => 'required|boolean',
        ], [
            'year.required' => 'O campo ano é obrigatório.',
            'year.integer' => 'O campo ano deve ser um número inteiro.',
            'year.between' => 'O campo ano deve estar entre 2005 e ' . date('Y') . '.',
            'current_year.required' => 'O campo ano corrente é obrigatório.',
            'current_year.boolean' => 'O campo ano corrente deve ser um valor booleano.',
        ]);

        $validatedData['author_id'] = auth()->id();

        $year->update($validatedData);

        return redirect()->route('admin.lms.years.index')->with('success', 'Ano Letivo atualizado com sucesso.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $year = $this->year->query()->findOrFail($id);
        if ($year->current_year){
            return redirect()->route('admin.lms.years.index')->with('error', 'O ano letivo corrente não pode ser excluído.');
        }

        if ($year->lessons()->exists()){
            return redirect()->route('admin.lms.years.index')->with('error', 'O ano letivo não pode ser excluído pois está vinculado a uma ou mais aulas.');
        }
        $year->delete();
        return redirect()->route('admin.lms.years.index')->with('success', 'Ano Letivo excluído com sucesso.');
    }
}
