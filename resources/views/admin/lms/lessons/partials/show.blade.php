<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Visualização de Aula') }}
        </h2>
        <span class="text-gray-700 dark:text-gray-200 mt-2 text-sm">Campos desabilitados - Apenas Visualização</span>
    </x-slot>
    @livewire('admin.components.alerts')
    <div class="py-2">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="rounded-lg bg-white dark:bg-gray-800 p-8 shadow-lg lg:col-span-3 lg:p-12">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="image">Capa da Aula</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">{{ $lesson->image }}</p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="title">Título</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">{{ $lesson->title }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div>
                                <label class="dark:text-gray-200" for="code">Código</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">{{ $lesson->code }}</p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="year_id">Ano Letivo</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">{{ $lesson->year->year }}</p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="lesson_date">Data de Realização da Aula</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    {{ date('d/m/Y', strtotime($lesson->lesson_date)) }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div>
                                <label class="dark:text-gray-200" for="grade">Série</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    <span class="inline-block bg-blue-100 text-blue-900 text-sm font-medium mb-1 me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-100">
                                        {{ $lesson->grade->title }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="course">Curso</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    <span class="inline-block bg-blue-100 text-blue-900 text-sm font-medium mb-1 me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-100">
                                        {{ $lesson->grade->course->title }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="subjects">Componentes</label>
                                <ul class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    @foreach($lesson->grade->subjects as $subject)
                                        <li>
                                            <span class="inline-block bg-blue-100 text-blue-900 text-sm font-medium mb-1 me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-100">
                                                {{ $subject->title }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="status">Status</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">{{ $lesson->status }}</p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="teachers_id">Ministrantes</label>
                                <ul class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    @foreach($lesson->teachers as $teacher)
                                        <li>
                                            <span class="inline-block bg-blue-100 text-blue-900 text-sm font-medium mb-1 me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-100">
                                                {{ $teacher->name }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="description">Descrição</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm"
                                    rows="4"
                                    id="description"
                                    name="description"
                                >{{ $lesson->description }}</textarea>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="tags">Tags</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm"
                                    rows="4"
                                    id="tags"
                                    name="tags"
                                >{{ $lesson->tags }}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="border rounded-lg divide-y divide-gray-400 border dark:border-gray-600">
                                <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                    {{ __('Conteúdo da Aula: ') }} {{ $lesson->title }}
                                </h2>
                                <div class="flex">
                                    <div class="w-fit py-2 px-2 w-1/2 text-start">
                                        <div class="relative max-w">
                                            <a href="{{ route('admin.lms.lessons.contents.create', ['lesson' => $lesson]) }}" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" wire:click="createUser">
                                                <x-icons.plus-circle aria-hidden="true" />
                                                <span class="ms-2">Novo Conteudo</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="w-fit py-2 px-2 w-1/2 text-start">
                                        <div class="relative max-w-xs sr-only">
                                            <label class="sr-only">Search</label>
                                            <input type="text" wire:model="search" placeholder="Pesquisar Conteúdo..." class="py-2 px-3 ps-9 block w-full dark:bg-gray-800 border-gray-200 dark:border-gray-500 shadow-sm rounded-lg dark:text-gray-200 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Search for items">
                                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                                <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="11" cy="11" r="8"></circle>
                                                    <path d="m21 21-4.3-4.3"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-400 dark:divide-gray-600">
                                        <thead class="bg-gray-300 dark:bg-gray-900">
                                        <tr>
                                            <th scope="col" class="py-3 px-4 pe-0">
                                                <div class="flex items-center h-5">
                                                    <input id="hs-table-pagination-checkbox-all" type="checkbox" class="border-gray-200 dark:border-gray-500 rounded text-blue-600 focus:ring-blue-500">
                                                    <label for="hs-table-pagination-checkbox-all" class="sr-only">Checkbox</label>
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">#</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Título</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Tipo de conteúdo</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">
                                                Principal
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                        @foreach($contents as $content)
                                            <tr class="dark:hover:bg-gray-600 hover:bg-gray-300">
                                                <td class="py-3 ps-4">
                                                    <div class="flex items-center h-5">
                                                        <input id="hs-table-pagination-checkbox-1" type="checkbox" class="border-gray-200 dark:border-gray-500 rounded text-blue-600 focus:ring-blue-500">
                                                        <label for="hs-table-pagination-checkbox-1" class="sr-only">Checkbox</label>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800 dark:text-gray-200">{{ $content->id }}</td>
                                                <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800 dark:text-gray-200">{{ $content->title }}</td>
                                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-800 dark:text-gray-200">{{ $content->content_type }}</td>
                                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $content->is_main ? 'Sim' : 'Não' }}
                                                </td>
                                                <td class="flex justify-end px-6 py-4 space-x-1 whitespace-normal text-sm font-medium">
                                                    <a href="{{ route('admin.lms.lessons.contents.show', ['lesson' => $lesson, 'content' => $content->id]) }}" type="button" class="text-blue-500" title="Detalhes de {{ $content->title }}">
                                                        <x-icons.eye aria-hidden="true" />
                                                    </a>
                                                    <a href="{{ route('admin.lms.lessons.contents.edit', ['lesson' => $lesson, 'content' => $content->id]) }}" type="button" class="text-blue-500" title="Editar {{ $content->title }}">
                                                        <x-icons.pencil-square aria-hidden="true" />
                                                    </a>
                                                    <form action="{{ route('admin.lms.lessons.contents.destroy', ['lesson' => $lesson, 'content' => $content->id]) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover este conteúdo? Esta ação é irreversível!')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-blue-500" title="Remover {{ $content->title }}">
                                                            <x-icons.x-circle aria-hidden="true" />
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="relative px-4 py-1 mt-4">
                                    <nav class="flex space-x-1 place-content-center">
                                        {{ $contents->onEachSide(2)->links() }}
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                            <a href="{{ route('admin.lms.lessons.index') }}" type="button" class="inline-flex items-center justify-center w-full text-center rounded-lg bg-blue-500 px-5 py-3 font-medium text-gray-200 sm:w-auto">
                                Voltar
                            </a>
                            <a href="{{ route('admin.lms.lessons.edit', $lesson->id) }}" type="button" class="inline-flex items-center justify-center w-full text-center rounded-lg bg-cyan-300 px-5 py-3 font-medium text-black sm:w-auto">
                                Editar
                            </a>
                            <form action="{{ route('admin.lms.lessons.destroy', $lesson->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover esta aula? A remoção desta aula resultará na remoção de todo seu conteúdo. Esta ação é irreversível!')">
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
