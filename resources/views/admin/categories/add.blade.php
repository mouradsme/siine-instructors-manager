<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catégories') }}
        </h2>
        <div class="flex flex-wrap  gap-6">
            <a class="relative" href="{{route('categories')}}">
                <span class="absolute top-0 left-0 mt-1 ml-1 h-full w-full rounded bg-black"></span>
                <span class="fold-bold relative inline-block h-full w-full rounded border-2 border-black bg-white px-3 py-1 text-base font-bold text-black transition duration-100 hover:bg-yellow-400 hover:text-gray-900 dark:bg-transparent">{{ __('Retour') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="flex items-center justify-center p-12">
            <div class="mx-auto w-full max-w-[550px] ">
                <form action="{{ route('categories.add.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                                    {{__('Désignation')}}
                                </label>
                                <input type="text" name="name" id="name" placeholder="{{__('Désignation')}}"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>

                    </div>


                    <div>
                        <button
                            class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            {{__('Ajouter')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
