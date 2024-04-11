<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Visualização do Curso') }}
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
                                <label class="dark:text-gray-200" for="author_id">Criador</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">{{ $course->author_id }}</p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="title">Título</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">{{ $course->title }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="image">Imagem</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">{{ $course->image }}</p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="slug">Slug</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">{{ $course->slug }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="category">Categoria</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    {{ $course->category->name }}
                                </p>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="status">Status</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    {{ $course->status }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="summary">Resumo</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed"
                                    placeholder="Descreva um pequeno resumo sobre o curso"
                                    rows="4"
                                    id="summary"
                                    name="summary"
                                    disabled
                                >{{ $course->summary }}</textarea>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="body">Conteúdo</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed"
                                    placeholder="Descreva o conteúdo do curso"
                                    rows="4"
                                    id="body"
                                    name="body"
                                    disabled
                                >{{ $course->body }}</textarea>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:text-center sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="featured">Destaque</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    {{ $course->featured ? 'Sim' : 'Não' }}
                                </p>
                            </div>

                            <div>
                                <label class="dark:text-gray-200" for="featured_menu">Mostrar no Menu</label>
                                <p class="mt-1 block w-full rounded-lg dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-not-allowed">
                                    {{ $course->featured_menu ? 'Sim' : 'Não'}}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                            <a href="{{ route('admin.lms.courses.index') }}" type="button" class="inline-flex items-center justify-center w-full text-center rounded-lg bg-blue-500 px-5 py-3 font-medium text-gray-200 sm:w-auto">
                                Voltar
                            </a>
                            <a href="{{ route('admin.lms.courses.edit', $course->id) }}" type="button" class="inline-flex items-center justify-center w-full text-center rounded-lg bg-cyan-300 px-5 py-3 font-medium text-black sm:w-auto">
                                Editar
                            </a>
                            <form action="{{ route('admin.lms.courses.destroy', $course->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover este curso? Esta ação é irreversível!')">
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
