<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public readonly User $user;
    public readonly Role $role;
    public readonly Department $department;
    public function __construct()
    {
        $this->user = new User();
        $this->role = new Role();
        $this->department = new Department();
    }

    public function index(): View
    {
        $users = $this->user->query()
            ->with(['roles', 'details'])
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('admin.acl.users.dashboard', compact('users'));
    }

    public function create(): View
    {
        $roles = $this->role->all();
        $departments = $this->department->all();
        return view('admin.acl.users.partials.create', compact('roles', 'departments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'status' => 'required|boolean',
            'departments' => 'nullable|array',
            'departments.*' => 'exists:departments,id',
            'about' => 'nullable|string',
            'website' => 'nullable|string',
            'lattes' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'github' => 'nullable|string',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'instagram' => 'nullable|string',
        ],[
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não deve exceder 255 caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'O campo senha deve ser uma string.',
            'password.min' => 'O campo senha deve ter no mínimo 8 caracteres.',
            'roles.required' => 'O campo funções é obrigatório.',
            'roles.array' => 'O campo funções deve ser um array.',
            'roles.*.exists' => 'Uma ou mais funções selecionadas não existem.',
            'status.required' => 'O campo status é obrigatório.',
            'status.boolean' => 'O campo status deve ser um booleano.',
            'departments.array' => 'O campo departamentos deve ser um array.',
            'departments.*.exists' => 'Um ou mais departamentos selecionados não existem.',
            'about.string' => 'O campo sobre deve ser uma string.',
            'website.string' => 'O campo website deve ser uma string.',
            'lattes.string' => 'O campo lattes deve ser uma string.',
            'linkedin.string' => 'O campo linkedin deve ser uma string.',
            'github.string' => 'O campo github deve ser uma string.',
            'facebook.string' => 'O campo facebook deve ser uma string.',
            'twitter.string' => 'O campo twitter deve ser uma string.',
            'instagram.string' => 'O campo instagram deve ser uma string.',
        ]);

        $user = $this->user->create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $user->roles()->sync($validatedData['roles']);
        $user->departments()->sync($validatedData['departments']);

        $user->details()->create([
            'status' => $validatedData['status'],
            'about' => $validatedData['about'],
            'website' => $validatedData['website'],
            'lattes' => $validatedData['lattes'],
            'linkedin' => $validatedData['linkedin'],
            'github' => $validatedData['github'],
            'facebook' => $validatedData['facebook'],
            'twitter' => $validatedData['twitter'],
            'instagram' => $validatedData['instagram'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function show(string $id): View
    {
        $user = $this->user->query()
            ->with(['roles', 'details', 'departments'])
            ->findOrFail($id);
        return view('admin.acl.users.partials.show', compact('user'));
    }

    public function edit(string $id): View
    {
        $user = $this->user->query()
            ->with(['roles', 'details', 'departments'])
            ->findOrFail($id);
        $roles = $this->role->all();
        $departments = $this->department->all();
        return view('admin.acl.users.partials.edit', compact('user', 'roles', 'departments'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|string|min:8',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'status' => 'required|boolean',
            'departments' => 'nullable|array',
            'departments.*' => 'exists:departments,id',
            'about' => 'nullable|string',
            'website' => 'nullable|string',
            'lattes' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'github' => 'nullable|string',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'instagram' => 'nullable|string',
        ],[
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não deve exceder 255 caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.string' => 'O campo senha deve ser uma string.',
            'password.min' => 'O campo senha deve ter no mínimo 8 caracteres.',
            'roles.required' => 'O campo funções é obrigatório.',
            'roles.array' => 'O campo funções deve ser um array.',
            'roles.*.exists' => 'Uma ou mais funções selecionadas não existem.',
            'status.required' => 'O campo status é obrigatório.',
            'status.boolean' => 'O campo status deve ser um booleano.',
            'departments.array' => 'O campo departamentos deve ser um array.',
            'departments.*.exists' => 'Um ou mais departamentos selecionados não existem.',
            'about.string' => 'O campo sobre deve ser uma string.',
            'website.string' => 'O campo website deve ser uma string.',
            'lattes.string' => 'O campo lattes deve ser uma string.',
            'linkedin.string' => 'O campo linkedin deve ser uma string.',
            'github.string' => 'O campo github deve ser uma string.',
            'facebook.string' => 'O campo facebook deve ser uma string.',
            'twitter.string' => 'O campo twitter deve ser uma string.',
            'instagram.string' => 'O campo instagram deve ser uma string.',
        ]);

        $user = $this->user->findOrFail($id);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
        ]);

        $user->roles()->sync($validatedData['roles']);
        $user->departments()->sync($validatedData['departments']);

        $user->details()->update([
            'status' => $validatedData['status'],
            'about' => $validatedData['about'],
            'website' => $validatedData['website'],
            'lattes' => $validatedData['lattes'],
            'linkedin' => $validatedData['linkedin'],
            'github' => $validatedData['github'],
            'facebook' => $validatedData['facebook'],
            'twitter' => $validatedData['twitter'],
            'instagram' => $validatedData['instagram'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $user = $this->user->findOrFail($id);
        if($user->lessons()->exists()) {
            return redirect()->route('admin.users.index')->with('error', 'Este usuário está vinculado a uma ou mais aulas.');
        }
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuário removido com sucesso!');
    }
}
