<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário de Edição de Aula') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="rounded-lg bg-white dark:bg-gray-800 p-8 shadow-lg lg:col-span-3 lg:p-12">
                    <form action="{{ route('admin.lms.lessons.update', $lesson->id) }}" enctype="multipart/form-data" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="image">Capa</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Nome Completo"
                                    type="file"
                                    id="image"
                                    name="image"
                                    value="{{ $lesson->image }}"
                                />
                                @error('image')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="title">Título</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Título da Aula"
                                    type="text"
                                    id="title"
                                    name="title"
                                    required
                                    value="{{ $lesson->title }}"
                                />
                                @error('title')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div>
                                <label class="dark:text-gray-200" for="code">Código</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Código Único da Aula"
                                    type="text"
                                    id="code"
                                    name="code"
                                    required
                                    x-mask="aaa9999"
                                    value="{{ $lesson->code }}"
                                />
                                @error('code')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="year_id">Ano Letivo</label>
                                <select
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="year_id"
                                    name="year_id"
                                    required
                                >
                                    <option disabled>Selecione um ano letivo</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->id }}" {{ $lesson->year_id === $year->id ? 'selected' : '' }}>{{ $year->year }}</option>
                                    @endforeach
                                </select>
                                @error('year_id')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="lesson_date">Data de Realização da Aula</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    type="date"
                                    id="lesson_date"
                                    name="lesson_date"
                                    required
                                    value="{{ $lesson->lesson_date }}"
                                />
                                @error('lesson_date')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div>
                                <label class="dark:text-gray-200" for="status">Status</label>
                                <select
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="status"
                                    name="status"
                                    required
                                >
                                    <option disabled>Selecione uma opção</option>
                                    <option value="PUBLICADO" {{ $lesson->status === 'PUBLICADO' ? 'selected' : '' }}>PUBLICADO</option>
                                    <option value="RASCUNHO" {{ $lesson->status === 'RASCUNHO' ? 'selected' : '' }}>RASCUNHO</option>
                                    <option value="PENDENTE" {{ $lesson->status === 'PENDENTE' ? 'selected' : '' }}>PENDENTE</option>
                                    <option value="CANCELADO" {{ $lesson->status === 'CANCELADO' ? 'selected' : '' }}>CANCELADO</option>
                                </select>
                                @error('status')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="grade_id">Série</label>
                                <select
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="grade_id"
                                    name="grade_id"
                                    required
                                >
                                    <option value="" selected disabled>Selecione uma opção</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}" {{ $lesson->grade->id === $grade->id ? 'selected' : '' }}>{{ $grade->title }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="teachers_id">Ministrantes</label>
                                <select
                                    class="w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="teachers_id"
                                    name="teachers_id[]"
                                    required
                                    multiple
                                >
                                    <option value="" selected disabled>Selecione pelo menos um ministrante</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $lesson->teachers->contains('id', $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('teachers_id')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="description">Descrição</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm"
                                    placeholder="Descreva o conteúdo da aula"
                                    rows="4"
                                    id="description"
                                    name="description"
                                >{{ $lesson->description }}</textarea>
                                @error('description')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="tags">Palavras Chave</label>
                                <textarea
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm"
                                    placeholder="Informe as palavras chave separadas por vírgula"
                                    rows="4"
                                    id="tags"
                                    name="tags"
                                >{{ $lesson->tags }}</textarea>
                                @error('tags')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
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
