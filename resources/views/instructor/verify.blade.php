<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vérification') }}

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
            <form action="{{ route('unverified.edit.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $Element->id }}" name="id">
                <div class="flex flex-wrap">


                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="order" class="mb-3 block text-base font-medium text-[#07074D]">
                                {{__('Ordre')}}
                            </label>
                            <input type="number" min="1" name="order" id="order" value="{{ $Element->order }}" placeholder="{{__('Ordre')}}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>

                    </div>

                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="title" class="mb-3 block text-base font-medium text-[#07074D]">
                                {{__('Titre')}}
                            </label>
                            <input type="text" name="title" id="title" value="{{ $Element->title }}" placeholder="{{__('Titre')}}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>

                    </div>

                    <div class="w-full px-3">
                        <div class="mb-5">
                            <label for="description" class="mb-3 block text-base font-medium text-[#07074D]">
                                {{__('Description')}}
                            </label>
                            <textarea type="text" name="description" id="description"  placeholder="{{__('Description')}}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{ $Element->description }}</textarea>
                        </div>
                    </div>
                    <hr />

                    <div class="w-full px-3">
                        <div class="mb-5">
                            <label for="documents" class="mb-3 block text-base font-medium text-[#07074D]">
                                {{__('Documents des quizzes')}}

                            </label>
                            <input type="file" name="documents" id="documents"  class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
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
                            <select name="status" id="status" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                @for($i = 0; $i < 2; $i++)
                                    <option value="{{ $i }}" @if ($Element->status == $i) selected @endif>{{ status($i) }}</option>
                                @endfor
                            </select>

                        </div>

                    </div>

                    <div class="w-full px-3 sm:w-1/2">
                        <button
                            class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            {{__('Mettre à jour')}}
                        </button>
                    </div>

                </div>


            </form>

            <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-16">
                <div class="px-4 py-2">
                    <h1 class="text-gray-800 font-bold text-2xl uppercase">Changements à faire</h1>
                </div>
                <button id="addNote" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Demander de faire un changement</button>

                <ul class="divide-y divide-gray-200 px-4">
                    @foreach ($Notes as $Note)
                    <li class="py-4">
                        <div class="flex w-full ">
                            <div class="w-full px-3 sm:w-1/2 ">
                                <input id="note_{{ $Note->id }}" name="note_{{ $Note->id }}" type="checkbox" disabled
                                @if ($Note->status == 0)  @else checked @endif
                                    class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                                <label for="todo1" class="ml-3 block text-gray-900">
                                    <span class="text-lg font-medium">{{ $Note->message}}</span>
                                </label>

                            </div>
                            <div class="w-full px-3 sm:w-1/2 ">

                                <a href="{{ route('note.delete.post', $Note->id) }}"
                                    class="hover:shadow-form rounded-md bg-[#ff0011] py-1 px-3 text-center text-base font-semibold text-white outline-none">
                                    {{__('Retirer')}}
                                </a>
                            </div>

                        </div>
                    </li>

                    @endforeach

                </ul>
            </div>
        </div>



    </div>

    <form action="{{ route('notes.add.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="video_id" value="{{ $Element->id }}">
        <dialog class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
              <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                  <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                  </div>
                  <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Changement à faire</h3>
                    <div class="mt-2">
                      <p class="text-sm text-gray-500">
                        <textarea cols="100%" type="text" name="message" id="message"  placeholder="{{__('Note')}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                    </p>
                    </div>


                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <input type="submit" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto" value="Ajouter" />
                <button id="closeDialog" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Annuler</button>
              </div>
            </div>
          </div>
        </div>
      </dialog>
    </form>

<script>
    const dialog = document.querySelector("dialog");
    const showButton = document.querySelector("#addNote");
    const closeButton = document.querySelector("#closeDialog");

    document.addEventListener('DOMContentLoaded', function () {
        showButton.addEventListener("click", () => {
            dialog.showModal();
        });

        closeButton.addEventListener("click", () => {
            dialog.close();
        });
    });
</script>
</x-app-layout>
