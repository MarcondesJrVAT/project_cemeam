<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário de Edição do Conteudo ') }} "{{ $content->title}}" {{ __(' da Aula ') }} "{{ $lesson->title }}"
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="rounded-lg bg-white dark:bg-gray-800 p-8 shadow-lg lg:col-span-3 lg:p-12">
                    <form action="{{ route('admin.lms.lessons.contents.update', ['lesson' => $lesson, 'content' => $content->id]) }}" enctype="multipart/form-data" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="title">Título</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Título da Aula"
                                    type="text"
                                    id="title"
                                    name="title"
                                    value="{{ $content->title }}"
                                    required
                                />
                                @error('title')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="is_main">Principal ?</label>
                                <select
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="is_main"
                                    name="is_main"
                                    required
                                >
                                    <option value="0" {{ $content->is_main === 0 ? 'selected' : '' }}>Não</option>
                                    <option value="1" {{ $content->is_main === 1 ? 'selected' : '' }}>Sim</option>
                                </select>
                                @error('is_main')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" x-data="{ contentType: '{{ $content->content_type }}' }">
                            <div>
                                <label class="dark:text-gray-200" for="content_type">Tipo de Conteúdo</label>
                                <select
                                    x-model="contentType"
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="content_type"
                                    name="content_type"
                                    required
                                >
                                    <option value="" disabled>Selecione uma opção</option>
                                    <option value="youtube">Youtube</option>
                                    <option value="url">URL</option>
                                    <option value="mp4">Video MP4</option>
                                    <option value="doc">Documento - *.doc/*.docx</option>
                                    <option value="pdf">PDF - *.pdf</option>
                                    <option value="ppt">PowerPoint - *.ppt/*.pptx</option>
                                    <option value="xls">Planilha - *.xls/*.xlsx</option>
                                    <option value="cartela">Cartela - *.doc/*.docx</option>
                                </select>
                                @error('content_type')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div x-show="['mp4', 'doc', 'pdf', 'ppt', 'xls', 'cartela'].includes(contentType)">
                                <label class="dark:text-gray-200" for="content_path">Arquivo</label>
                                <input
                                    class="block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    type="file"
                                    id="content_path"
                                    name="content_path"
                                    value="{{ $content->content_path }}"
                                />
                                @error('content_path')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div x-show="['youtube', 'url'].includes(contentType)">
                                <label class="dark:text-gray-200" for="content_path">Link</label>
                                <input
                                    class="block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="http:// ou https://"
                                    type="text"
                                    id="content_path"
                                    name="content_path"
                                    value="{{ $content->content_path }}"
                                />
                                @error('content_path')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="dark:text-gray-200" for="description">Descrição</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm"
                                    placeholder="Descreva este conteúdo"
                                    rows="4"
                                    id="description"
                                    name="description"
                                >{{ $content->description }}</textarea>
                                @error('description')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
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
