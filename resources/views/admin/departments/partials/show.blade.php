<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Visualização do Departamento:') }} {{ $department->name }}
        </h2>
        <span class="text-gray-700 dark:text-gray-200 mt-2 text-sm">Campos desabilitados - Apenas Visualização</span>
    </x-slot>
    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="rounded-lg bg-white dark:bg-gray-800 p-8 shadow-lg lg:col-span-3 lg:p-12">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div>
                                <label class="dark:text-gray-200" for="image">Imagem</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    {{ $department->image }}
                                </p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="name">Departamento</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    {{ $department->name }}
                                </p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="responsible_id">Responsável</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    {{ $department->responsible->name }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                            <div>
                                <label class="dark:text-gray-200" for="parent_id">Departamento Pai</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    {{ $department->parent->name }}
                                </p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="order">Ordem</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    {{ $department->order }}
                                </p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="background_color">Cor do card</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    <label class="p-1 rounded-lg text-black font-bold" style="background-color: {{ $department->background_color }}">
                                        {{ $department->background_color }}
                                    </label>
                                </p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="is_active">Ativo</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    {{ $department->status ? 'Sim' : 'Não' }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="summary">Descrição resumida</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed"
                                    placeholder="Descreva mais detalhes sobre o departamento"
                                    rows="4"
                                    id="summary"
                                    name="summary"
                                    disabled
                                >{{ $department->summary }}</textarea>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="description">Descrição Completa</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed"
                                    placeholder="Descreva mais detalhes sobre o departamento"
                                    rows="4"
                                    id="description"
                                    name="description"
                                    disabled
                                >{{ $department->description }}</textarea>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                            <a href="{{ route('admin.departments.index') }}" type="button" class="inline-flex items-center justify-center w-full text-center rounded-lg bg-blue-500 px-5 py-3 font-medium text-gray-200 sm:w-auto">
                                Voltar
                            </a>
                            <a href="{{ route('admin.departments.edit', $department->id) }}" type="button" class="inline-flex items-center justify-center w-full text-center rounded-lg bg-cyan-300 px-5 py-3 font-medium text-black sm:w-auto">
                                Editar
                            </a>
                            <form action="{{ route('admin.departments.destroy', $department->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover este departamento? Esta ação é irreversível!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center w-full text-center rounded-lg bg-red-500 px-5 py-3 font-medium text-gray-200 sm:w-auto">
                                    Remover
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
