<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PermissionController extends Controller
{
    public readonly Permission $permission;
    public function __construct()
    {
        $this->permission = new Permission();
    }

    public function index(): View
    {
        $permissions = $this->permission->query()
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('admin.acl.permissions.dashboard', compact('permissions'));
    }

    public function create(): View
    {
        return view('admin.acl.permissions.partials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,slug',
        ], [
            'name.required' => 'O campo permissão é obrigatório.',
            'name.string' => 'O campo permissão deve ser uma string.',
            'name.max' => 'O campo permissão não deve exceder 255 caracteres.',
            'name.unique' => 'Esta permissão já existe.',
        ]);

        $permission = $this->permission->create([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name']),
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permissão criada com sucesso.');
    }

    public function show(string $id): View
    {
        $permission = $this->permission->query()->findOrFail($id);
        return view('admin.acl.permissions.partials.show', compact('permission'));
    }

    public function edit(string $id): View
    {
        $permission = $this->permission->query()->findOrFail($id);
        return view('admin.acl.permissions.partials.edit', compact('permission'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $permission = $this->permission->query()->findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,slug,' . $permission->id,
        ], [
            'name.required' => 'O campo permissão é obrigatório.',
            'name.string' => 'O campo permissão deve ser uma string.',
            'name.max' => 'O campo permissão não deve exceder 255 caracteres.',
            'name.unique' => 'Esta permissão já existe.',
        ]);

        $permission->update([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name']),
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permissão atualizada com sucesso.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $permission = $this->permission->query()->findOrFail($id);
        if ($permission->roles()->exists()) {
            return redirect()->route('admin.permissions.index')->with('error', 'Esta permissão está vinculada a uma ou mais funções.');
        }
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Permissão deletada com sucesso.');
    }
}
