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
                    <form action="{{ route('admin.lms.subjects.update', $subject->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div>
                                <label class="dark:text-gray-200" for="title">Título</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Título do componente"
                                    type="text"
                                    id="title"
                                    name="title"
                                    value="{{ $subject->title }}"
                                    required
                                />
                                @error('title')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="code">Código</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Código Único do Componente"
                                    type="text"
                                    id="code"
                                    name="code"
                                    value="{{ $subject->code }}"
                                    required
                                />
                                @error('code')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="status">Status</label>
                                <select
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="status"
                                    name="status"
                                    required
                                >
                                    <option value="" disabled>Selecione status</option>
                                    <option value="PUBLICADO" {{ $subject->status === "PUBLICADO" ? 'selected' : '' }}>PUBLICADO</option>
                                    <option value="RASCUNHO" {{  $subject->status === "PUBLICADO" ? 'selected' : '' }}>RASCUNHO</option>
                                    <option value="PENDENTE" {{  $subject->status === "PUBLICADO" ? 'selected' : '' }}>PENDENTE</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="dark:text-gray-200" for="description">Descrição</label>
                            <textarea
                                class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm"
                                placeholder="Descreva mais sobre o componente curricular"
                                rows="4"
                                id="description"
                                name="description"
                            >{{  $subject->description }}</textarea>
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
