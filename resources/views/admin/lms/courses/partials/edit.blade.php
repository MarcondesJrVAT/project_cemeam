<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário de Edição de Curso') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="rounded-lg bg-white dark:bg-gray-800 p-8 shadow-lg lg:col-span-3 lg:p-12">
                    <form action="{{ route('admin.lms.courses.update', $course->id) }}" enctype="multipart/form-data" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="image">Imagem</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Imagem"
                                    type="file"
                                    id="image"
                                    name="image"
                                    value="{{ $course->image }}"
                                />
                                @error('image')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="title">Título</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Título do Curso"
                                    type="text"
                                    id="title"
                                    name="title"
                                    required
                                    value="{{ $course->title }}"
                                />
                                @error('title')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:text-center sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="category_id">Categorias</label>
                                <select
                                    class="w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="category_id"
                                    name="category_id"
                                    required
                                >
                                    <option value="" selected disabled>Selecione uma categoria</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $course->category_id === $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="dark:text-gray-200" for="status">Status</label>
                                <select
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="status"
                                    name="status"
                                    required
                                >
                                    <option value="" selected disabled>Selecione . . .</option>
                                    <option value="PUBLICADO" {{ $course->status === "PUBLICADO" ? 'selected' : '' }}>PUBLICADO</option>
                                    <option value="RASCUNHO" {{ $course->status === "RASCUNHO" ? 'selected' : '' }}>RASCUNHO</option>
                                    <option value="PENDENTE" {{ $course->status === "PENDENTE" ? 'selected' : '' }}>PENDENTE</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="summary">Resumo</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm"
                                    placeholder="Descreva um pequeno resumo sobre o curso"
                                    rows="4"
                                    id="summary"
                                    name="summary"
                                >{{ $course->summary }}</textarea>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="body">Conteúdo</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm"
                                    placeholder="Descreva o conteúdo do curso"
                                    rows="4"
                                    id="body"
                                    name="body"
                                >{{ $course->body }}</textarea>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:text-center sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="featured">Destaque</label>
                                <select
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="featured"
                                    name="featured"
                                    required
                                >
                                    <option value="0" {{ $course->featured === 0 ? 'selected' : ''}}>Desabilitado</option>
                                    <option value="1" {{ $course->featured === 1 ? 'selected' : ''}}>Habilitado</option>
                                </select>
                            </div>

                            <div>
                                <label class="dark:text-gray-200" for="featured_menu">Mostrar no Menu</label>
                                <select
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="featured_menu"
                                    name="featured_menu"
                                    required
                                >
                                    <option value="0" {{ $course->featured_menu === 0 ? 'selected' : ''}}>Desabilitado</option>
                                    <option value="1" {{ $course->featured_menu === 1 ? 'selected' : ''}}>Habilitado</option>
                                </select>
                            </div>
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
