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
                    <form action="{{ route('admin.lms.grades.update', $grade->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="title">Título</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Título da Série"
                                    type="text"
                                    id="title"
                                    name="title"
                                    required
                                    value="{{ $grade->title }}"
                                />
                                @error('title')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="course_id">Cursos</label>
                                <select
                                    class="w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="course_id"
                                    name="course_id"
                                    required
                                >
                                    <option value="" selected disabled>Selecione um curso</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ $grade->course->id === $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                @error('course_id')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:text-center sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="subjects">Componentes</label>
                                <select
                                    class="w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="subjects"
                                    name="subjects[]"
                                    required
                                    multiple
                                >
                                    <option value="" selected disabled>Selecione pelo menos um componente</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ $grade->subjects->contains('id', $subject->id) ? 'selected' : '' }}>{{ $subject->title }}</option>
                                    @endforeach
                                </select>
                                @error('subjects')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="status">Status</label>
                                <select
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="status"
                                    name="status"
                                    required
                                >
                                    <option value="PUBLICADO" {{ $grade->status === "PUBLICADO" ? 'selected' : ''}}>Publicado</option>
                                    <option value="RASCUNHO" {{ $grade->status === "RASCUNHO" ? 'selected' : ''}}>Rascunho</option>
                                    <option value="PENDENTE"  {{ $grade->status === "PENDENTE" ? 'selected' : ''}}>Pendente</option>
                                </select>
                                @error('status')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div>
                            <label class="dark:text-gray-200" for="description">Descrição</label>
                            <textarea
                                class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm"
                                placeholder="Descreva mais sobre esta série"
                                rows="4"
                                id="description"
                                name="description"
                            >{{ $grade->description }}</textarea>
                            @error('description')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
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
