<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Visualização de Aula') }}
        </h2>
        <span class="text-gray-700 dark:text-gray-200 mt-2 text-sm">Campos desabilitados - Apenas Visualização</span>
    </x-slot>
    <div class="py-12">
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
                        <div class="flex flex-col sm:flex-row mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                            <a href="{{ route('admin.lms.lessons.index') }}" type="button" class="inline-flex items-center justify-center w-full text-center rounded-lg bg-blue-500 px-5 py-3 font-medium text-gray-200 sm:w-auto">
                                Voltar
                            </a>
                            <a href="{{ route('admin.lms.lessons.edit', $lesson->id) }}" type="button" class="inline-flex items-center justify-center w-full text-center rounded-lg bg-cyan-300 px-5 py-3 font-medium text-black sm:w-auto">
                                Editar
                            </a>
                            <form action="{{ route('admin.lms.lessons.destroy', $lesson->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover esta aula? Esta ação é irreversível!')">
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
