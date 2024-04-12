<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário de Novo Departamento') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="rounded-lg bg-white dark:bg-gray-800 p-8 shadow-lg lg:col-span-3 lg:p-12">
                    <form action="{{ route('admin.departments.store') }}" enctype="multipart/form-data" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div>
                                <label class="dark:text-gray-200" for="image">Imagem</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    type="file"
                                    id="image"
                                    name="image"
                                />
                                @error('image')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="name">Departamento</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Nome do departamento"
                                    type="text"
                                    id="name"
                                    name="name"
                                    required
                                />
                                @error('name')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="responsible_id">Responsável</label>
                                <select
                                    class="w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="responsible_id"
                                    name="responsible_id"
                                    required
                                >
                                    <option value="" selected disabled>Selecione um responsável</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('responsible_id')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                            <div>
                                <label class="dark:text-gray-200" for="parent_id">Departamento Pai</label>
                                <select
                                    class="w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="parent_id"
                                    name="parent_id"
                                    required
                                >
                                    <option selected>Selecione um departamento pai</option>
                                    <option value=""> ---- NENHUM ---- </option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="order">Ordem</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Ordem de prioridade"
                                    id="order"
                                    name="order"
                                    required
                                    x-mask="99"
                                />
                                @error('order')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="background_color">Cor</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 h-12 cursor-pointer"
                                    type="color"
                                    placeholder="Coloração do card"
                                    id="background_color"
                                    name="background_color"
                                    required
                                />
                                @error('background_color')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="is_active">Ativo</label>
                                <select
                                    class="w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="is_active"
                                    name="is_active"
                                    required
                                >
                                    <option value="0" selected>Não</option>
                                    <option value="1">Sim</option>
                                </select>
                                @error('is_active')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:text-center sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="summary">Descrição resumida</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm"
                                    placeholder="Descreva resumidamente o departamento"
                                    rows="4"
                                    id="summary"
                                    name="summary"
                                ></textarea>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="description">Descrição completa</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm"
                                    placeholder="Descreva mais detalhes sobre o departamento"
                                    rows="4"
                                    id="description"
                                    name="description"
                                ></textarea>
                            </div>
                        </div>
                        <div class="mt-4 space-y-2">
                            <button type="submit" class="inline-block w-full rounded-lg bg-blue-500 px-5 py-3 font-medium text-white sm:w-auto">
                                Finalizar
                            </button>
                            <a href="{{ route('admin.departments.index') }}" type="button" class="inline-block w-full text-center rounded-lg bg-red-400 px-5 py-3 font-medium text-gray-200 sm:w-auto">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
