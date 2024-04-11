<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Usuários') }}
        </h2>
    </x-slot>
    <div class="w-full">
        @if (session()->has('success'))
            <div id="alert" class="place-content-center bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative flex transition-opacity duration-500 ease-in-out" role="alert">
                <div>
                    <strong class="font-bold">Cadastrado!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="relative right-0 ease-in-out">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"></path></svg>
                </button>
            </div>
        @endif
    </div>
    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="border rounded-lg divide-y divide-gray-200 border dark:border-gray-500">
                                    <div class="flex items">
                                        <div class="py-3 px-4 w-1/2 text-start">
                                            <div class="relative max-w-xs sr-only">
                                                <label class="sr-only">Search</label>
                                                <input type="text" wire:model="search" placeholder="Pesquisar Usuários..." class="py-2 px-3 ps-9 block w-full dark:bg-gray-800 border-gray-200 dark:border-gray-500 shadow-sm rounded-lg dark:text-gray-200 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Search for items">
                                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                                    <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="11" cy="11" r="8"></circle>
                                                        <path d="m21 21-4.3-4.3"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="py-3 px-4 w-1/2 text-end">
                                            <div class="relative max-w">
                                                <a href="{{ route('admin.users.create') }}" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" wire:click="createUser">
                                                    <x-icons.plus-circle aria-hidden="true" />
                                                    <span class="ms-2">Adicionar Usuário</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="overflow-hidden">

                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-500">
                                            <thead class="bg-gray-50 dark:bg-gray-800">
                                            <tr>
                                                <th scope="col" class="py-3 px-4 pe-0">
                                                    <div class="flex items-center h-5">
                                                        <input id="hs-table-pagination-checkbox-all" type="checkbox" class="border-gray-200 dark:border-gray-500 rounded text-blue-600 focus:ring-blue-500">
                                                        <label for="hs-table-pagination-checkbox-all" class="sr-only">Checkbox</label>
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">#</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Nome</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Email</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Sobre</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Funções</th>
                                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Ações</th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                            @foreach($users as $user)
                                                <tr class="dark:hover:bg-gray-600 hover:bg-gray-300">
                                                    <td class="py-3 ps-4">
                                                        <div class="flex items-center h-5">
                                                            <input id="hs-table-pagination-checkbox-1" type="checkbox" class="border-gray-200 dark:border-gray-500 rounded text-blue-600 focus:ring-blue-500">
                                                            <label for="hs-table-pagination-checkbox-1" class="sr-only">Checkbox</label>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800 dark:text-gray-200">{{ $user->id }}</td>
                                                    <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                                                    <td class="w-96 px-6 py-4 whitespace-normal text-sm text-gray-800 dark:text-gray-200">{{ $user->details ? $user->details->about : ' ' }}</td>
                                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-800 dark:text-gray-200">
                                                        @foreach($user->roles as $role)
                                                            <span class="inline-block bg-blue-100 text-blue-900 text-sm font-medium mb-1 me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-100">
                                                                {{ $role->slug }}
                                                            </span>
                                                        @endforeach
                                                    </td>
                                                    <td class="flex justify-end px-6 py-4 space-x-1 whitespace-normal text-sm font-medium">
                                                        <a href="{{ route('admin.users.show', $user->id) }}" type="button" class="text-blue-500" title="Detalhes de {{ $user->name }}">
                                                            <x-icons.eye aria-hidden="true" />
                                                        </a>
                                                        <a href="{{ route('admin.users.edit', $user->id) }}" type="button" class="text-blue-500" title="Editar {{ $user->name }}">
                                                            <x-icons.pencil-square aria-hidden="true" />
                                                        </a>
                                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover este usuário? Esta ação é irreversível!')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-blue-500" title="Remover {{ $user->name }}" wire:click="confirmUserRemoval({{ $user->id }})">
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
                                            {{ $users->onEachSide(2)->links() }}
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
