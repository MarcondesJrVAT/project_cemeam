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
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="name">Nome</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Nome Completo"
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ $user->name }}"
                                    required
                                />
                                @error('name')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="email">E-mail</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Endereço de E-mail"
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ $user->email }}"
                                    required
                                />
                                @error('email')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="dark:text-gray-200" for="password">Senha</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Pelo menos 8 caracteres - Deixe em branco para não alterar"
                                    type="password"
                                    id="password"
                                    name="password"
                                />
                                @error('password')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="password_confirmation">Confirme sua Senha</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Pelo menos 8 caracteres - Deixe em branco para não alterar"
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                />
                                @error('password')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:text-center sm:grid-cols-3">
                            <div>
                                <label class="dark:text-gray-200" for="roles">Funções</label>
                                <select
                                    class="w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="roles"
                                    name="roles[]"
                                    required
                                    multiple
                                >
                                    <option value="" disabled>Selecione pelo menos uma função</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
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
                                    <option value="1" {{ $user->details->status === 1 ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ $user->details->status === 0 ? 'selected' : '' }}>Inativo</option>
                                </select>
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="departments">Departamentos</label>
                                <select
                                    class="w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    id="departments"
                                    name="departments[]"
                                    required
                                    multiple
                                >
                                    <option value="" disabled>Selecione pelo menos uma função</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ $user->departments->contains('id', $department->id) ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="dark:text-gray-200" for="about">Sobre</label>
                            <textarea
                                class="w-full rounded-lg focus:border-blue-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm"
                                placeholder="Descreva mais detalhes sobre você"
                                rows="4"
                                id="about"
                                name="about"
                            >{{ $user->details->about }}</textarea>
                        </div>
                        <hr>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                            <div>
                                <label class="dark:text-gray-200" for="website">Website</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="URL do Website"
                                    type="url"
                                    id="website"
                                    name="website"
                                    value="{{ $user->details->website }}"
                                />
                                @error('website')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="lattes">Currículo Lattes</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="URL do seu Currículo Lattes"
                                    type="url"
                                    id="lattes"
                                    name="lattes"
                                    value="{{ $user->details->lattes }}"
                                />
                                @error('lattes')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="linkedin">LinkedIn</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="URL do seu perfil no LinkedIn"
                                    type="url"
                                    id="linkedin"
                                    name="linkedin"
                                    value="{{ $user->details->linkedin }}"
                                />
                                @error('linkedin')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="github">GitHub</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="URL do seu Perfil no GitHub"
                                    type="url"
                                    id="github"
                                    name="github"
                                    value="{{ $user->details->github }}"
                                />
                                @error('github')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label class="dark:text-gray-200" for="facebook">Facebook</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Url do seu perfil no Facebook"
                                    type="url"
                                    id="facebook"
                                    name="facebook"
                                    value="{{ $user->details->facebook }}"
                                />
                                @error('facebook')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="twitter">Twitter - X</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Url do seu perfil no Twitter"
                                    type="url"
                                    id="twitter"
                                    name="twitter"
                                    value="{{ $user->details->twitter }}"
                                />
                                @error('twitter')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="dark:text-gray-200" for="instagram">Instagram</label>
                                <input
                                    class="mt-1 block w-full rounded-lg focus:border-gray-200 dark:bg-gray-900 dark:text-gray-200 p-3 text-sm cursor-pointer"
                                    placeholder="Url do seu perfil no Instagram"
                                    type="url"
                                    id="instagram"
                                    name="instagram"
                                    value="{{ $user->details->instagram }}"
                                />
                                @error('instagram')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
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
