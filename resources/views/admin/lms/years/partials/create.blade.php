<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário de Novo Ano Letivo') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="rounded-lg bg-white dark:bg-gray-800 p-8 shadow-lg lg:col-span-3 lg:p-12">
                    <form action="{{ route('admin.lms.years.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 md:text-center sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="roles">Anos</label>
                                <select
                                    class="w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="year"
                                    name="year"
                                    required
                                >
                                    <option value="" selected disabled>Selecione um ano letivo</option>
                                    @foreach($availableYears as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="dark:text-gray-200" for="current_year">Atual</label>
                                <select
                                    class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="current_year"
                                    name="current_year"
                                    required
                                >
                                    <option value="1" selected>Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4 space-y-2">
                            <button type="submit" class="inline-block w-full rounded-lg bg-blue-500 px-5 py-3 font-medium text-white sm:w-auto">
                                Finalizar
                            </button>
                            <a href="{{ route('admin.lms.years.index') }}" type="button" class="inline-block w-full text-center rounded-lg bg-red-400 px-5 py-3 font-medium text-gray-200 sm:w-auto">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>