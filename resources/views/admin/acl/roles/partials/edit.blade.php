<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário de Edição de Usuário') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="rounded-lg bg-white dark:bg-gray-800 p-8 shadow-lg lg:col-span-3 lg:p-12">
                    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="name">Função</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Nome Completo"
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ $role->name }}"
                                    required
                                />
                                @error('name')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="slug">Slug</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed"
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ $role->slug }}"
                                    disabled
                                />
                                @error('slug')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="dark:text-gray-200" for="permissions">Permissões</label>
                                <select
                                    class="w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="permissions"
                                    name="permissions[]"
                                    required
                                    multiple
                                >
                                    <option value="" selected disabled>Selecione pelo menos uma permissão</option>
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}" @if($role->permissions->contains($permission)) selected @endif>{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="mt-4 space-y-2">
                            <button type="submit" class="inline-block w-full rounded-lg bg-blue-500 px-5 py-3 font-medium text-white sm:w-auto">
                                Atualizar
                            </button>
                            <a href="{{ url()->previous() }}" type="button" class="inline-block w-full text-center rounded-lg bg-red-400 px-5 py-3 font-medium text-gray-200 sm:w-auto">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
