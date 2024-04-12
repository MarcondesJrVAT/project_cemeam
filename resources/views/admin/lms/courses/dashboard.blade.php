<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cursos') }}
        </h2>
    </x-slot>
    @livewire('admin.components.alerts')
    <div class="py-2">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="border rounded-lg divide-y divide-gray-400 border dark:border-gray-600">
                                    <div class="flex">
                                        <div class="w-fit py-2 px-2 w-1/2 text-start">
                                            <div class="relative max-w">
                                                <a href="{{ route('admin.lms.courses.create') }}" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" wire:click="createUser">
                                                    <x-icons.plus-circle aria-hidden="true" />
                                                    <span class="ms-2">Novo Curso</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="w-fit py-2 px-2 w-1/2 text-start">
                                            <div class="relative max-w-xs sr-only">
                                                <label class="sr-only">Search</label>
                                                <input type="text" wire:model="search" placeholder="Pesquisar Cursos..." class="py-2 px-3 ps-9 block w-full dark:bg-gray-800 border-gray-200 dark:border-gray-500 shadow-sm rounded-lg dark:text-gray-200 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Search for items">
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
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Imagem</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Título</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Status</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Destaque</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Mostrar no Menu</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Aulas</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Anexos</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Séries</th>
                                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Ações</th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                            @foreach($courses as $course)
                                                <tr class="dark:hover:bg-gray-600 hover:bg-gray-300">
                                                    <td class="py-3 ps-4">
                                                        <div class="flex items-center h-5">
                                                            <input id="hs-table-pagination-checkbox-1" type="checkbox" class="border-gray-200 dark:border-gray-500 rounded text-blue-600 focus:ring-blue-500">
                                                            <label for="hs-table-pagination-checkbox-1" class="sr-only">Checkbox</label>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800 dark:text-gray-200">Capa</td>
                                                    <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800 dark:text-gray-200">{{ $course->title }}</td>
                                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-800 dark:text-gray-200">{{ $course->status }}</td>
                                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-800 dark:text-gray-200">
                                                        @if($course->featured)
                                                            <span class="inline-block bg-green-100 text-green-900 text-sm font-medium mb-1 me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-100">
                                                                Sim
                                                            </span>
                                                        @else
                                                            <span class="inline-block bg-red-100 text-red-900 text-sm font-medium mb-1 me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-100">
                                                                Não
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-800 dark:text-gray-200">
                                                        @if($course->featured_menu)
                                                            <span class="inline-block bg-green-100 text-green-900 text-sm font-medium mb-1 me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-100">
                                                                Sim
                                                            </span>
                                                        @else
                                                            <span class="inline-block bg-red-100 text-red-900 text-sm font-medium mb-1 me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-100">
                                                                Não
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $course->lessons->count() }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-800 dark:text-gray-200">000 Anexos</td>
                                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $course->grades->count() }}
                                                    </td>
                                                    <td class="flex justify-end px-6 py-4 space-x-1 whitespace-normal text-sm font-medium">
                                                        <a href="{{ route('admin.lms.courses.show', $course->id) }}" type="button" class="text-blue-500" title="Detalhes de {{ $course->title }}">
                                                            <x-icons.eye aria-hidden="true" />
                                                        </a>
                                                        <a href="{{ route('admin.lms.courses.edit', $course->id) }}" type="button" class="text-blue-500" title="Editar {{ $course->title }}">
                                                            <x-icons.pencil-square aria-hidden="true" />
                                                        </a>
                                                        <form action="{{ route('admin.lms.courses.destroy', $course->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover este curso? Esta ação é irreversível!')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-blue-500" title="Remover {{ $course->title }}">
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
                                            {{ $courses->onEachSide(2)->links() }}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const alert = document.getElementById('alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = 0;
                    setTimeout(() => alert.remove(), 500);
                }, 3000);
            }
        });
    </script>
@endpush
