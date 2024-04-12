<div class="w-full flex justify-center my-2 mx-2">
    @if (session()->has('success'))
        <div id="alert" class="w-fit z-50 fixed top-16 right-1 md:right-5">
            <div class="flex inline-flex justify-between bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 my-2 rounded " role="alert">
                <span class="block sm:inline pl-2">
                    <strong class="block font-medium text-green-800"> Tudo Certo! </strong>
                    <p class="mt-1 text-sm text-green-600">{{ session('success') }}</p>
                </span>
                <span class="inline ml-2" onclick="return this.parentNode.remove();">
                    <x-icons.x-circle aria-hidden="true" />
                </span>
            </div>
        </div>
    @endif
    @if (session()->has('error'))
        <div id="alert" class="w-fit z-50 fixed top-16 right-1 md:right-5">
            <div class="flex inline-flex justify-between bg-red-100 border border-red-400 text-red-700 px-4 py-3 my-2 rounded-xl " role="alert">
                <span class="block sm:inline pl-2">
                    <strong class="block font-medium text-red-600"> AVISO! </strong>
                    <p class="mt-1 text-sm text-red-500">{{ session('error') }}</p>
                </span>
                <span class="inline ml-2" onclick="return this.parentNode.remove();">
                    <x-icons.x-circle aria-hidden="true" />
                </span>
            </div>
        </div>
    @endif
</div>
