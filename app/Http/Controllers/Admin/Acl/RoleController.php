<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RoleController extends Controller
{
    public readonly Role $role;
    public readonly Permission $permission;
    public function __construct()
    {
        $this->role = new Role();
        $this->permission = new Permission();
    }

    public function index(): View
    {
        $roles = $this->role->query()
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('admin.acl.roles.dashboard', compact('roles'));
    }

    public function create(): View
    {
        $permissions = $this->permission->all();
        return view('admin.acl.roles.partials.create', compact('permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,slug',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ], [
            'name.required' => 'O campo função é obrigatório.',
            'name.string' => 'O campo função deve ser uma string.',
            'name.max' => 'O campo função não deve exceder 255 caracteres.',
            'name.unique' => 'Esta função já existe.',
            'permissions.required' => 'O campo permissões é obrigatório.',
            'permissions.array' => 'O campo permissões deve ser um array.',
            'permissions.*.exists' => 'Uma ou mais permissões selecionadas não existem.',
        ]);

        $role = $this->role->create([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name']),
        ]);

        $role->permissions()->sync($validatedData['permissions']);

        return redirect()->route('admin.roles.index')->with('success', 'Função criada com sucesso.');
    }

    public function show(string $id): View
    {
        $role = $this->role->query()->findOrFail($id);
        return view('admin.acl.roles.partials.show', compact('role'));
    }

    public function edit(string $id): View
    {
        $role = $this->role->query()->findOrFail($id);
        $permissions = $this->permission->all();
        return view('admin.acl.roles.partials.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $role = $this->role->query()->findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,slug,' . $role->id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ], [
            'name.required' => 'O campo função é obrigatório.',
            'name.string' => 'O campo função deve ser uma string.',
            'name.max' => 'O campo função não deve exceder 255 caracteres.',
            'name.unique' => 'Esta função já existe.',
            'permissions.required' => 'O campo permissões é obrigatório.',
            'permissions.array' => 'O campo permissões deve ser um array.',
            'permissions.*.exists' => 'Uma ou mais permissões selecionadas não existem.',
        ]);

        $role->update([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name']),
        ]);

        $role->permissions()->sync($validatedData['permissions']);

        return redirect()->route('admin.roles.index')->with('success', 'Função atualizada com sucesso.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $role = $this->role->query()->findOrFail($id);
        if ($role->users()->exists()) {
            return redirect()->route('admin.roles.index')->with('error', 'Esta função não pode ser excluída, pois está vinculada a um ou mais usuários.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Função excluída com sucesso.');
    }
}
