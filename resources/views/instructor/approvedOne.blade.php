<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Approuvé') }}

        </h2>
    </x-slot>

    <div class="py-12 flex relative " >
        <div class="w-full sticky top-10 stickyVideo">
            <div class=" dark:bg-gray-800 overflow-hidden  sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <iframe width="100%" height="500px" src="{{ $Element->video }}?si=cEHOwzj4lQtjLvwf" frameborder="0" allow="accelerometer; autoplay; clipboard-write; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>

            </div>
        </div>
        <div class="mx-auto w-full max-w-[550px] ">
                <div class="flex flex-wrap">


                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="order" class="mb-3 block text-base font-medium text-[#07074D]">
                                {{__('Ordre')}}
                            </label>
                            <div class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{ $Element->order }}</div>
                        </div>

                    </div>

                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="title" class="mb-3 block text-base font-medium text-[#07074D]">
                                {{__('Titre')}}
                            </label>
                            <div class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{ $Element->title }}</div>
                        </div>

                    </div>

                    <div class="w-full px-3">
                        <div class="mb-5">
                            <label for="description" class="mb-3 block text-base font-medium text-[#07074D]">
                                {{__('Description')}}
                            </label>
                            <div  class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{ $Element->description }}</div>
                        </div>
                    </div>
                    <hr />

                    <div class="w-full px-3 mb-5">
                        @if ($Element->quiz_file !== null)
                        <a href="{{ asset($Element->quiz_file) }}"
                            class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            {{__('Fichier')}}
                        </a>
                        @else
                        Aucun fichier n'a encore été ajouté
                        @endif
                    </div>
                        <hr>
                    <div class="w-full px-3">
                        <div class="mb-5">
                            <label for="status" class="mb-3 block text-base font-medium text-[#07074D]">
                                {{__('Etat')}}
                            </label>
                            
                            <div  class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{ status($Element->status) }}</div>


                        </div>

                    </div>


                </div>


        </div>



    </div>
</x-app-layout>
