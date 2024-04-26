<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <ul class="flex flex-col md:grid grid-cols-3 gap-5 text-redis-neutral-800 max-w-2xl mx-auto p-10 mt-10">
                    <li
                        class="w-full text-sm font-semibold text-slate-900 p-6 bg-white border border-slate-900/10 bg-clip-padding shadow-md shadow-slate-900/5 rounded-lg flex flex-col justify-center">
                        <span class="mb-1 text-teal-400 font-display text-5xl">45K+</span>
                        Usuários
                    </li>
                    <li
                        class="w-full text-sm font-semibold text-slate-900 p-6 bg-white border border-slate-900/10 bg-clip-padding shadow-md shadow-slate-900/5 rounded-lg flex flex-col justify-center">
                        <span class="mb-1 text-teal-400 font-display text-5xl">78K+</span>
                        Downloads
                    </li>
                    <li
                        class="w-full text-sm font-semibold text-slate-900 p-6 bg-white border border-slate-900/10 bg-clip-padding shadow-md shadow-slate-900/5 rounded-lg flex flex-col justify-center">
                        <span class="mb-1 text-teal-400 font-display text-5xl">50+</span>
                        Products
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
