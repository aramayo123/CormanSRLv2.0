<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <div class="border-solid border-2 border-gray-300 rounded-lg">
                    <section class="flex gap-5 my-5 py-3">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('img_profile/' . Auth::user()->avatar) }}"
                                class="rounded-full w-[10rem] object-cover" alt="...">
                        @else
                            <img src="{{ asset('img_profile/default.jpg') }}"
                                class="rounded-full w-[10rem] object-cover" alt="">
                        @endif
                        <h2 class="text-center mx-auto text-2xl my-2">Bienvenid@ {{ Auth::user()->name }}</h2>
                    </section>
                    <section>
                      @include('profile.partials.update-avatar')
                    </section>
                </div>
                <div class="border-solid border-2 border-gray-300 my-5 py-3 rounded-lg">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="border-solid border-2 border-gray-300 my-5 py-3 rounded-lg">
                    @include('profile.partials.update-password-form')
                </div>
                <!--
                <div class="border-solid border-2 border-gray-300 my-5 py-3 rounded-lg">
                    @include('profile.partials.delete-user-form')
                </div>
                !-->
            </div>
        </div>
    </div>
</x-app-layout>
