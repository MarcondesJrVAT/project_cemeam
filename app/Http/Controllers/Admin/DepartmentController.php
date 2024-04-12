<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public readonly Department $department;
    public readonly User $user;
    public function __construct()
    {
        $this->department = new Department();
        $this->user = new User();
    }

    public function index(): View
    {
        $departments = $this->department->query()
            ->with('users')
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('admin.departments.dashboard', compact('departments'));
    }

    public function create(): View
    {
        $users = $this->user->all();
        $departments = $this->department->all();
        return view('admin.departments.partials.create', compact('users', 'departments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'responsible_id' => 'required|exists:users,id',
            'parent_id' => 'nullable|exists:departments,id',
            'order' => 'required|integer',
            'background_color' => 'required|string|max:7',
            'is_active' => 'required|boolean',
            'summary' => 'required|string|max:255',
            'description' => 'required|string',
        ],[
            'image.image' => 'O arquivo deve ser uma imagem',
            'image.mimes' => 'O arquivo deve ser uma imagem do tipo: jpeg, png, jpg, gif, svg',
            'image.max' => 'O arquivo deve ter no máximo 2048 kilobytes',
            'name.required' => 'O campo nome é obrigatório',
            'name.string' => 'O campo nome deve ser uma string',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'responsible_id.required' => 'O campo responsável é obrigatório',
            'responsible_id.exists' => 'O responsável informado não existe',
            'parent_id.exists' => 'O departamento pai informado não existe',
            'order.required' => 'O campo ordem é obrigatório',
            'order.integer' => 'O campo ordem deve ser um número inteiro',
            'background_color.required' => 'O campo cor de fundo é obrigatório',
            'background_color.string' => 'O campo cor de fundo deve ser uma string',
            'background_color.max' => 'O campo cor de fundo deve ter no máximo 7 caracteres',
            'is_active.required' => 'O campo ativo é obrigatório',
            'is_active.boolean' => 'O campo ativo deve ser um booleano',
            'summary.required' => 'O campo resumo é obrigatório',
            'summary.string' => 'O campo resumo deve ser uma string',
            'summary.max' => 'O campo resumo deve ter no máximo 255 caracteres',
            'description.required' => 'O campo descrição é obrigatório',
            'description.string' => 'O campo descrição deve ser uma string',
        ]);

        $image = $request->hasFile('image');
        if ($image){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/departments', $imageName);
            $validatedData['image'] = $imageName;
        }else{
            $validatedData['image'] = null;
        }

        $validatedData['slug'] = Str::slug($validatedData['name']);
        $validatedData['author_id'] = auth()->id();

        $this->department->create($validatedData);

        return redirect()->route('admin.departments.index')->with('success', 'Departamento criado com sucesso');
    }

    public function show(string $id): View
    {
        $department = $this->department->query()->with('users')->findOrFail($id);
        return view('admin.departments.partials.show', compact('department'));
    }

    public function edit(string $id): View
    {
        $department = $this->department->query()->with('users')->findOrFail($id);
        $users = $this->user->all();
        $departments = $this->department->all();
        return view('admin.departments.partials.edit', compact('department', 'users', 'departments'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'responsible_id' => 'required|exists:users,id',
            'parent_id' => 'nullable|exists:departments,id',
            'order' => 'required|integer',
            'background_color' => 'required|string|max:7',
            'is_active' => 'required|boolean',
            'summary' => 'required|string|max:255',
            'description' => 'required|string',
        ],[
            'image.image' => 'O arquivo deve ser uma imagem',
            'image.mimes' => 'O arquivo deve ser uma imagem do tipo: jpeg, png, jpg, gif, svg',
            'image.max' => 'O arquivo deve ter no máximo 2048 kilobytes',
            'name.required' => 'O campo nome é obrigatório',
            'name.string' => 'O campo nome deve ser uma string',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'responsible_id.required' => 'O campo responsável é obrigatório',
            'responsible_id.exists' => 'O responsável informado não existe',
            'parent_id.exists' => 'O departamento pai informado não existe',
            'order.required' => 'O campo ordem é obrigatório',
            'order.integer' => 'O campo ordem deve ser um número inteiro',
            'background_color.required' => 'O campo cor de fundo é obrigatório',
            'background_color.string' => 'O campo cor de fundo deve ser uma string',
            'background_color.max' => 'O campo cor de fundo deve ter no máximo 7 caracteres',
            'is_active.required' => 'O campo ativo é obrigatório',
            'is_active.boolean' => 'O campo ativo deve ser um booleano',
            'summary.required' => 'O campo resumo é obrigatório',
            'summary.string' => 'O campo resumo deve ser uma string',
            'summary.max' => 'O campo resumo deve ter no máximo 255 caracteres',
            'description.required' => 'O campo descrição é obrigatório',
            'description.string' => 'O campo descrição deve ser uma string',
        ]);

        $department = $this->department->query()->findOrFail($id);

        $image = $request->hasFile('image');
        if ($image){
            if ($department->image){
                Storage::disk('public')->delete('departments/' . $department->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/departments', $imageName);
            $validatedData['image'] = $imageName;
        }else{
            $validatedData['image'] = $department->image;
        }

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $department->update($validatedData);

        return redirect()->route('admin.departments.index')->with('success', 'Departamento atualizado com sucesso');
    }

    public function destroy(string $id): RedirectResponse
    {
        $department = $this->department->findOrFail($id);
        if ($department->children->count() > 0){
            return redirect()->route('admin.departments.index')->with('error', 'Departamento não pode ser removido, pois está vinculado a uma ou mais departamentos!');
        }
        if ($department->users->count() > 0){
            return redirect()->route('admin.departments.index')->with('error', 'Departamento não pode ser removido, pois está vinculado a uma ou mais usuários!');
        }
        if ($department->image){
            Storage::disk('public')->delete('departments/' . $department->image);
        }
        $department->delete();

        return redirect()->route('admin.departments.index')->with('success', 'Departamento excluído com sucesso');
    }
}
