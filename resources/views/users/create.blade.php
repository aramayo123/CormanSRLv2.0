<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <form action="{{ route('users.store') }}" method="post" class="max-w-xl mx-auto">
                        @csrf
                        <div class="mb-5">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba un nombre para el usuario: <p class="inline-block text-red-500">*</p></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
                            <x-mi-input-error :messages="$errors->get('name')" />
                        </div>
                        <div class="mb-5">
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba un nombre usuario: <p class="inline-block text-red-500">*</p></label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            <x-mi-input-error :messages="$errors->get('username')" />
                        </div>
                        <div class="mb-5">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba una contraseña para el usuario: <p class="inline-block text-red-500">*</p></label>
                            <input type="password" id="password" name="password" value="{{ old('password') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            <x-mi-input-error :messages="$errors->get('password')" />
                        </div>
                        <div class="mb-5">
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 ">Repita la contraseña: <p class="inline-block text-red-500">*</p></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            <x-mi-input-error :messages="$errors->get('password_confirmation')" />
                        </div>
                        <div class="mb-5">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba un email para el usuario: <p class="inline-block text-red-500">*</p></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            <x-mi-input-error :messages="$errors->get('email')" />
                        </div>
                        <div class="mb-5 flex gap-5">
                            <div>
                                <label for="area" class="block mb-2 text-sm font-medium text-gray-900 ">Código de area: <p class="inline-block text-gray-500">(opcional)</p></label>
                                <input type="number" id="area" name="area" value="{{ old('area') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                                <x-mi-input-error :messages="$errors->get('area')" />
                            </div>
                            <div>
                                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Numero de telefono sin el 15: <p class="inline-block text-gray-500">(opcional)</p></label>
                                <input type="number" id="phone" name="phone" value="{{ old('phone') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                                <x-mi-input-error :messages="$errors->get('phone')" />
                            </div>
                        </div>
                        @can('roles')
                        <div class="mb-5">
                            <p class="inline-block mb-2 text-sm font-medium text-gray-900 ">ROLES: <p class="inline-block text-red-500">*</p></p>
                            @foreach ($roles as $role)
                                <div class="flex items-center mb-4">
                                    <input id="default-radio-{{ $role->id }}" type="radio" value="{{ $role->id }}" name="role" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    <label for="default-radio-{{ $role->id }}" class="ms-2 text-sm font-medium text-gray-900">{{ $role->name }}</label>
                                </div>
                            @endforeach                           
                        </div>
                        @endcan
                        <div class="mx-auto text-center">
                            <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-blue-700 bg-blue-800 text-white border-blue-600 hover:text-white hover:bg-blue-700">
                                CREAR
                            </button>
                            <a href="{{ url('/users')}}">
                                <button type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-red-700 bg-red-800 text-white border-red-600 hover:text-white hover:bg-red-700">
                                    CANCELAR
                                </button>    
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
